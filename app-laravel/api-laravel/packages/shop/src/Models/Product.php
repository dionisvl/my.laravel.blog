<?php

declare(strict_types=1);

namespace Dionisvl\Shop\Models;

use App\Models\Category;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class Post.
 * @package App\Models
 * @property int id
 * @property string slug
 * @property int user_id
 * @property string image
 * @property int category_id
 * @property Comment[]|Collection comments
 */
class Product extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'date',
        'detail_text',
        'preview_text',
        'detail_picture',
        'preview_picture',
        'price',
        'balance',
        'composition',
        'features',
        'size',
        'manufacturer',
        'delivery',
        'stars',
    ];

    public static function add($fields): self
    {
        $product = new static();

        $product->fill($fields);
        $product->slug = static::getSlug($fields['title']);
        $product->user_id = Auth::user()->id;
        $product->save();

        return $product;
    }

    private static function getSlug($title): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 2;
        while (static::whereSlug($slug)->exists()) {
            $slug = "{$original}-" . $count++;
        }
        return $slug;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function edit($fields): void
    {
        $this->fill($fields);
        $this->save();
    }

    public function remove(): void
    {
        $this->removeImage('detail_picture');
        $this->removeImage('preview_picture');
        $this->delete();
    }

    public function removeImage(string $type_picture): void
    {
        if ($this->{$type_picture} !== null) {
            Storage::delete('storage/shop_uploads/' . $this->{$type_picture});
        }
    }

    public function uploadImage($file_picture, string $type_picture): void
    {
        if (empty($file_picture)) {
            return;
        }

        $this->removeImage($type_picture);
        $filename = Str::random(10) . '.' . $file_picture->extension();
        $file_picture->storeAs('storage/shop_uploads', $filename);
        $this->{$type_picture} = $filename;
        $this->save();
    }

    public function getImage(string $type_picture): string
    {
        if ($this->{$type_picture} === null) {
            return '/storage/shop_uploads/no-image.png';
        }
        return '/storage/shop_uploads/' . $this->{$type_picture};
    }

    public function setCategory($id): void
    {
        if ($id === null) {
            return;
        }
        $this->category_id = $id;
        $this->save();
    }

    public function getCategoryTitle(): string
    {
        return $this->category->title ?? 'Нет категории';
    }

    public function related()
    {
        return self::where('category_id', '=', $this->category_id)
            ->take(5)
            ->get()
            ->except($this->id);
    }

    public function getComments(): Collection
    {
        return $this->comments()->where('status', 1)->get();
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function getUrl(): string
    {
        return '//' . $_SERVER['HTTP_HOST'] . '/' . $this->slug;
    }

    public function getCategoryID()
    {
        return $this->category->id ?? null;
    }

    public function setDateAttribute($value): void
    {
        if (empty($value)) {
            $this->attributes['date'] = null;
            return;
        }

        $this->attributes['date'] = Carbon::parse($value)->format('Y-m-d');
    }
}
