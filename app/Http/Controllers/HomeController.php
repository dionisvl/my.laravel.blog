<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Tag;
use App\Post;
use Auth;
use Illuminate\Http\Request;


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


    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        mb_internal_encoding("UTF-8");
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
