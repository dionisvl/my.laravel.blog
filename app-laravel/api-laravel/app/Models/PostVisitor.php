<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostVisitor extends Model
{
    protected $table = 'post_visitor';
    protected $fillable = ['post_id', 'visitor_id',];
}
