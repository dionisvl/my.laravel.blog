<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * Class Tag.
 * @package App\Models
 * @property string slug
 */
class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(
            Post::class,
            'post_tags',
            'tag_id',
            'post_id'
        );
    }

    public static function create($fields): Tag
    {
        $tag = new static();
        $tag->fill($fields);
        $tag->slug = Str::slug($fields['title']);
        $tag->save();

        return $tag;
    }
}
