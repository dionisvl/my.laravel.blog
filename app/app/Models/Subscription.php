<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Subscription.
 * @package App\Models
 * @property string email
 * @property string token
 */
class Subscription extends Model
{
    public static function add($email): self
    {
        $sub = new static();
        $sub->email = $email;
        $sub->save();

        return $sub;
    }

    public function generateToken(): void
    {
        $this->token = str_random(100);
        $this->save();
    }

    public function remove(): void
    {
        $this->delete();
    }
}
