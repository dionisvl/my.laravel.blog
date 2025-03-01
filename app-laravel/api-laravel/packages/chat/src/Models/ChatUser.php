<?php

declare(strict_types=1);

namespace Dionisvl\Chat\Models;

use Illuminate\Database\Eloquent\Model;
use RuntimeException;
use Throwable;

/**
 * Class FrontPart.
 */
class ChatUser extends Model
{
    protected $table = 'chat_users';

    protected $fillable = [
        'user_name',
        'user_color',
        'user_ip',
        'status',
    ];

    public static function add($fields): self
    {
        $entity = new static();

        $entity->fill($fields);
        $entity->save();

        return $entity;
    }

    public static function getByIp()
    {
    }


    public function edit($fields): void
    {
        $this->fill($fields);
        $this->save();
    }

    public function remove(): void
    {
        try {
            $this->delete();
        } catch (Throwable $e) {
            throw new RuntimeException('error during deleting ' . __CLASS__ . ' element');
        }
    }
}
