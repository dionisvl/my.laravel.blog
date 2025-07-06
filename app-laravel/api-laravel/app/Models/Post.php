<?php

declare(strict_types=1);

namespace App\Models;

use App\Http\Controllers\PostController;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class Post.
 * @package App\Models
 * @property int id
 * @property string slug
 * @property int user_id
 * @property bool is_featured
 * @property string image
 * @property bool status
 * @property Carbon created_at
 * @property int category_id
 * @property Tag[]|Collection tags
 * @property-read bool isLiked
 */
class Post extends Model
{
    use HasFactory;

    public const IS_DRAFT = 0;
    public const IS_PUBLIC = 1;

    protected $fillable = ['title', 'content', 'date', 'description', 'views_count'];

    protected $casts = [
        'date' => 'string',
    ];

    public function setDateAttribute($value): void
    {
        if (empty($value)) {
            $this->attributes['date'] = null;
            return;
        }

        $this->attributes['date'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(PostLike::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            Tag::class,
            'post_tags',
            'post_id',
            'tag_id'
        );
    }

    public static function add($fields): self
    {
        $post = new static();
        $post->fill($fields);
        $post->slug = Str::slug($fields['title']);
        $post->user_id = Auth::user()->id ?? 1;
        $post->save();

        return $post;
    }

    public function edit($fields): void
    {
        $this->fill($fields);
        $this->save();
    }

    public function remove(): void
    {
        $this->removeImage();
        $this->delete();
    }

    public function removeImage(): void
    {
        if ($this->image !== null) {
            Storage::delete('storage/uploads/' . $this->image);
        }
    }

    public function uploadImage($image): void
    {
        if ($image === null) {
            return;
        }

        $this->removeImage();
        $timestamp = Carbon::now()->format('Y-m-d_H-i-s');
        $filename = $timestamp . '_' . Str::random(4) . '.' . $image->extension();
        $image->storeAs('storage/uploads', $filename);
        $this->image = $filename;
        $this->save();
    }

    public function getImage(): string
    {
        if ($this->image === null) {
            return '/storage/blog_images/no-image.png';
        }
        return '/storage/uploads/' . $this->image;
    }

    public function setCategory($id): void
    {
        if ($id === null) {
            return;
        }
        $this->category_id = $id;
        $this->save();
    }

    public function setTags($ids): void
    {
        $this->tags()->sync($ids);
    }

    private function setDraft(): void
    {
        $this->status = self::IS_DRAFT;
        $this->save();
    }

    private function setPublic(): void
    {
        $this->status = self::IS_PUBLIC;
        $this->save();
    }

    public function toggleStatus($value): void
    {
        if (empty($value)) {
            $this->setDraft();
            return;
        }

        $this->setPublic();
    }

    private function setFeatured(): void
    {
        $this->is_featured = 1;
        $this->save();
    }

    private function setStandard(): void
    {
        $this->is_featured = 0;
        $this->save();
    }

    public function toggleFeatured($value): void
    {
        if (empty($value)) {
            $this->setStandard();
            return;
        }

        $this->setFeatured();
    }

    public function getCategoryTitle(): string
    {
        return $this->category->title ?? 'Нет категории';
    }

    public function getTagsTitles(): string
    {
        return (!$this->tags->isEmpty())
            ? implode(', ', $this->tags->pluck('title')->all())
            : 'Нет тегов';
    }

    public function getCategoryID()
    {
        return $this->category->id ?? null;
    }

    public function getDate()
    {
        return $this->created_at->format('F d, Y');
    }

    public function getPrevious()
    {
        return self::where('id', '<', $this->id)->first();
    }

    public function getNext()
    {
        return self::where('id', '>', $this->id)->first();
    }

    public function related()
    {
        return self::where('category_id', '=', $this->category_id)->take(5)->get()->except($this->id);
    }

    public function hasCategory(): bool
    {
        return $this->category !== null;
    }

    public static function getPopularPosts()
    {
        return self::orderBy('views', 'desc')->take(3)->get();
    }

    public function getComments(): Collection
    {
        return $this->comments()->where('status', 1)->get();
    }

    public function getUrl(): string
    {
        return '//' . $_SERVER['HTTP_HOST'] . '/post/' . $this->slug;
    }

    public function getViewsCount(): int
    {
        return empty($this->views_count) ? 1 : (int)$this->views_count;
    }

    public function updateViewsCount(): void
    {
        ++$this->views_count;
        $this->save();
    }

    public function getDescription(): string
    {
        return empty($this->description)
            ? 'Справочник по тематике программирования на языках PHP, JS'
            : strip_tags((string)$this->description);
    }

    public function getTitle(): string
    {
        if (Request::is('/')) {
            return config('app.main_title');
        }

        if (empty($this->title)) {
            return 'Лучшие практики PHP, JS, SQL, блог программиста.';
        }

        return $this->title;
    }

    protected function isLiked(): Attribute
    {
        return Attribute::make(get: fn() => PostController::isLiked($this->id));
    }
}
