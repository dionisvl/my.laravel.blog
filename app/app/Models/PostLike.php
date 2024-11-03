<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PostLike.
 * @package App\Models
 * @property string created_at
 */
class PostLike extends Model
{
    protected $table = 'posts_likes';

    protected $fillable = ['post_id', 'ip', 'device_memory'];
}
