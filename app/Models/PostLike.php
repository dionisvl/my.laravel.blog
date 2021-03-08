<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    protected $table = 'posts_likes';

    protected $fillable = ['post_id', 'ip', 'device_memory'];
}
