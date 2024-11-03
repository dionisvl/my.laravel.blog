<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incoming extends Model
{
    public function remove(): void
    {
        $this->delete();
    }
}
