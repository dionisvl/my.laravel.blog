<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = htmlspecialchars($request->q, ENT_QUOTES);

        $post = Post::where('title', 'LIKE', '%' . $q . '%')
            ->orWhere('description', 'LIKE', '%' . $q . '%')
            ->orWhere('content', 'LIKE', '%' . $q . '%')->get();

        if (count($post) > 0)
            return view('pages.search')->withDetails($post)->withQuery($q);
        else
            return view('pages.search')->withMessage('No Details found. Try to search again !');
    }
}
