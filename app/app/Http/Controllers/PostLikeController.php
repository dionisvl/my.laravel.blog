<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\PostLike;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cookie;

class PostLikeController extends Controller
{
    /**
     * Если лайк поставлен тогда удалим
     *
     * @OA\Post(
     * path="/postlike/{post_id}",
     * summary="Post likes",
     * description="Toggle like for this post for this day",
     * operationId="post.likes",
     * tags={"postlikes.toggle"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Transfer of the liker fingerprint",
     *    @OA\JsonContent(
     *       @OA\Property(property="device_memory", type="int", format="int", example="8"),
     *    ),
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Show status of liked",
     *     @OA\JsonContent(
     *          @OA\Property(property="status", type="string", example="ok"),
     *          @OA\Property(property="data", type="string", example="liked/unliked"),
     *      )
     *    )
     * )
     *)
     * @param int $post_id
     * @return JsonResponse
     */
    public function toggle(int $post_id): JsonResponse
    {
        if (empty($post_id)) {
            return response()->json([
                'status' => 'error',
                'data' => 'empty post_id',
            ]);
        }

        if (PostController::isLiked($post_id)) {
            PostLike::where(
                [
                    ['post_id', '=', $post_id],
                    ['created_at', '=', Cookie::get('likedPostToday' . $post_id)],
                ]
            )
                ->delete();

            return response()->json(
                [
                    'status' => 'ok',
                    'data' => 'unliked',
                ]
            )->withCookie(Cookie::forget('likedPostToday' . $post_id));
        }

        $fields = request()->all();
        $postLike = new PostLike();
        $postLike->fill($fields);
        $postLike->post_id = $post_id;
        $postLike->ip = $this->getIp();
        $postLike->save();

        return response()->json([
            'status' => 'ok',
            'data' => 'liked',
        ])->cookie(
            'likedPostToday' . $post_id,
            $postLike->created_at,
            60 * 24
        );
    }

    public function getIp()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }
        return $ipaddress;
    }

    /**
     * Display the specified resource.
     *
     * @param int $post_id
     * @return JsonResponse
     */
    public function show(int $post_id): JsonResponse
    {
        $count = $this->getCount($post_id);

        return response()->json([
            'count' => $count,
        ]);
    }

    public function getCount(int $post_id)
    {
        return PostLike::where('post_id', $post_id)->count();
    }
}
