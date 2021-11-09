<?php

namespace App\Models;

use Dionisvl\Shop\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * Class Category
 * @property string slug
 */
class Category extends Model
{
    protected $fillable = ['title', 'detail_text', 'preview_text'];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public static function create($fields): self
    {
        $category = new static();
        $category->fill($fields);
        $category->slug = static::getSlug($fields['title']);
        $category->save();

        return $category;
    }

    public function edit($fields): void
    {
        $this->fill($fields);
        $this->slug = static::getSlug($fields['title']);
        $this->save();
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
}
