<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    protected $fillable = ['title'];

    public function posts()
    {
        return $this->belongsToMany(
            Post::class,
            'post_tags',
            'tag_id',
            'post_id'
        );
    }

    public static function create($fields)
    {
        $tag = new static;
        $tag->fill($fields);
        $tag->slug = Str::slug($fields['title']);
        $tag->save();

        return $tag;
    }
}
