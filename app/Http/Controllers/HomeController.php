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
        $aphorisms_count = DB::table('aphorism')->count();
        $today = date('d');
        $post = Post::where('slug', $slug)
            ->select(DB::raw('posts.*, aphorism.detail_text as aphorism_detail_text'))
            ->join('aphorism', 'aphorism.id', '=', DB::raw("$aphorisms_count - 365 - posts.id + $today"))
            ->firstOrFail();
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
