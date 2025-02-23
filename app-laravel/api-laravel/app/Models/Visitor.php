<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $table = 'visitor';
    protected $fillable = ['ip', 'browser', 'platform', 'referer', 'target'];
}
