<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = ['title', 'detail_text', 'preview_text'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public static function create($fields)
    {
        $category = new static;
        $category->fill($fields);
        $category->slug = static::getSlug($fields['title']);
        $category->save();

        return $category;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->slug = static::getSlug($fields['title']);
        $this->save();
    }

    private static function getSlug($title)
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
