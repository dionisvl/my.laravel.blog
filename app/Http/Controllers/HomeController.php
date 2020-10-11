<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Tag;
use App\Post;
use Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            //authorized
        } else {
            //guest
        }

        $app_main_module = config('app.main_module');
        if ($app_main_module == '/') {
            $posts = Post::orderBy('posts.created_at', 'desc')->paginate(20);
            return view('pages.index')->with('posts', $posts);
        } else {
            return redirect($app_main_module);
        }
    }

    public function contacts()
    {
        return view('pages.contacts');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }


    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)
            ->select(DB::raw('posts.*'))
            ->firstOrFail();

        $postId = $post->id;

        $aphorismsCount = DB::table('aphorism')->count();
        $needleAphorismId = $aphorismsCount - 365 - $postId + date('d');
        $aphorism = DB::table('aphorism')
            ->where('aphorism.id', '=', $needleAphorismId)
            ->first();

        if (!empty($aphorism)) {
            return view('pages.show', ['post' => $post, 'aphorism' => $aphorism]);
        }

        return view('pages.show', compact('post'));
    }

    public function showById(int $id)
    {
        $post = Post::where('id', $id)->firstOrFail();
        return view('pages.show', compact('post'));
    }

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->paginate(10);
        return view('pages.list', ['posts' => $posts]);
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->paginate(10);
        return view('pages.list', ['posts' => $posts]);
    }
}
