<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Dionisvl\Shop\Http\Controllers\ProductController;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    public function index()
    {
        switch (config('app.main_module')) {
            case '/posts':
                return (new PostController())->index();

            case '/shop':
                return (new ProductController())->index();

            default:
                return new Response('error: APP_MAIN_MODULE not defined in .env');
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
