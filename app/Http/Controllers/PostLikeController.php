<?php

namespace App\Http\Controllers;

use App\PostLike;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;

class PostLikeController extends Controller
{
    /** Если лайк поставлен тогда удалим */
    public function toggle(int $post_id)
    {
        if (empty($post_id)) {
            return response()->json([
                'status' => 'error',
                'data' => 'empty post_id'
            ]);
        }

        if (PostController::isLiked($post_id)) {

            $deletedRows = PostLike::where([
                ['post_id', '=', $post_id],
                ['created_at', '=', Cookie::get('likedPostToday' . $post_id)]
            ])
//                ->whereDate('created_at', Carbon::today())
                ->delete();

            return response()->json([
                'status' => 'ok',
                'data' => 'unliked'
            ])->withCookie(Cookie::forget('likedPostToday' . $post_id));
        } else {
            $fields = request()->all();
            $postLike = new PostLike();
            $postLike->fill($fields);
            $postLike->post_id = $post_id;
            $postLike->ip = $this->getIp();
            $postLike->save();

            return response()->json([
                'status' => 'ok',
                'data' => 'liked'
            ])->cookie(
                'likedPostToday' . $post_id, $postLike->created_at, 60 * 24
            );
        }
    }

    public function getIp()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    /**
     * Display the specified resource.
     *
     * @param int $post_id
     * @return void
     */
    public function show(int $post_id)
    {
        $count = $this->getCount($post_id);

        return response()->json([
            'count' => $count
        ]);
    }

    public function getCount(int $post_id)
    {
        return PostLike::where('post_id', $post_id)->count();
    }
}

