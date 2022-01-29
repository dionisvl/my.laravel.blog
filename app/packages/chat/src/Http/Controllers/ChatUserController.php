<?php

namespace Dionisvl\Chat\Http\Controllers;

use App\Http\Controllers\Controller;
use Dionisvl\Chat\Models\ChatUser;

class ChatUserController extends Controller
{
    public function saveNewUser(string $name, string $color = 'black')
    {
        $params = [
            'user_name' => $name,
            'user_color' => $color,
            'user_ip' => 'localhost',
            'status' => 1,
        ];
        ChatUser::add($params);
        return json_encode(['status' => 'ok', 'message' => 'succesfully saved']);
    }

    public static function getCurUserId()
    {
        $user_id = 0;

        ChatUser::getByIp();
        return $user_id;
    }
}
