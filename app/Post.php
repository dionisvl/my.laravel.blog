<?php

namespace App;

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    public const IS_DRAFT = 0;
    public const IS_PUBLIC = 1;

    protected $fillable = ['title', 'content', 'date', 'description', 'views_count'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PostLike::class);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'post_tags',
            'post_id',
            'tag_id'
        );
    }

    public static function add($fields): Post
    {
        $post = new static;
        $post->fill($fields);
        $post->slug = Str::slug($fields['title']);
        $post->user_id = Auth::user()->id;
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
        $filename = str_random(10) . '.' . $image->extension();
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

    public function setDateAttribute($value): void
    {
        $date = Carbon::createFromFormat('d/m/y', $value)->format('Y-m-d');
        $this->attributes['date'] = $date;
    }

    public function getDateAttribute(): string
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d/m/y');
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
        return date('F d, Y', strtotime($this->created_at));
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

    public function getComments()
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
        return empty($this->description) ? 'Cправочник по тематике программирования на языках PHP, JS' : strip_tags($this->description);
    }

    public function getTitle(): string
    {
        if (\Request::is('/')) {
            return 'WIKI, блог программиста, лучшие практики PHP, JS, SQL';
        }

        if (empty($this->title)) {
            return 'Лучшие практики PHP, JS, SQL, блог программиста.';
        }

        return $this->title;
    }

    /* Аксессор для получения количества лайков, $post->likes_count*/
//    public function getLikesCountAttribute()
//    {
//        return $this->likes()->where('post_id', $this->id)->count();
//    }

    /* Аксессор для определения поставлен ли лайк этим пользователем, $post->is_liked */
    public function getIsLikedAttribute(): bool
    {
        return PostController::isLiked($this->id);
    }
}
