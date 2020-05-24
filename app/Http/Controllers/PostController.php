<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\Cookie;

class PostController
{
    public static function isLiked(int $post_id)
    {

        if (empty(Cookie::get('likedPostToday' . $post_id))) {
            return false;
        } else {
            return true;
        }
    }
}
