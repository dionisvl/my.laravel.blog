<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = htmlspecialchars($request->q, ENT_QUOTES);

        $posts = Post::where('title', 'LIKE', '%' . $q . '%')
            ->orWhere('description', 'LIKE', '%' . $q . '%')
            ->orWhere('content', 'LIKE', '%' . $q . '%')->limit(20)->get();

        return view('pages.search')->withDetails($posts)->withQuery($q);
    }
}
