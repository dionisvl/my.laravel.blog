<?php

declare(strict_types=1);

namespace Dionisvl\Chat\Http\Controllers;

use App\Http\Controllers\Controller;
use Dionisvl\Chat\Models\ChatMessage;
use Dionisvl\Chat\Models\ChatUser;

class ChatMessageController extends Controller
{
    public function getAllMessages()
    {

    }

    public function pushNewMessage(string $message = 'wtf empty message', int $status = 1)
    {
        $params = [
            'user_id' => ChatUser::getCurUserId(),
            'message' => $message,
            'status' => $status,
        ];
        ChatMessage::add($params);
    }
}
