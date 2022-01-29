<?php

namespace Dionisvl\Chat\Http\Controllers;

use App\Http\Controllers\Controller;
use Dionisvl\Chat\Models\ChatMessage;
use Dionisvl\Chat\Models\ChatUser;
use Illuminate\Support\Facades\Artisan;

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
