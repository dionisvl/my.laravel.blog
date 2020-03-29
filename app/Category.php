<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = ['title'];

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
        $category->slug = Str::slug($fields['title']);
        $category->save();

        return $category;
    }
}
