<?php

namespace Dionisvl\Chat\Models;

use Illuminate\Database\Eloquent\Model;
use RuntimeException;
use Throwable;

/**
 * Online chat message
 */
class ChatMessage extends Model
{
    protected $table = 'chat_messages';

    protected $fillable = [
        'user_id',
        'message',
        'status',
    ];

    public static function add($fields): self
    {
        $entity = new static;

        $entity->fill($fields);
        $entity->save();

        return $entity;
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
