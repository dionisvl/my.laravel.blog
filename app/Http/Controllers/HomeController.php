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

//        $posts = Post::orderBy('posts.created_at', 'desc')->paginate(20);
//        return view('pages.index')->with('posts', $posts);
        $products = Product::orderBy('products.created_at', 'desc')->paginate(20);
        return view('pages.products')->with('products', $products);
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
