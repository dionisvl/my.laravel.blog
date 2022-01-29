<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class SitemapController extends Controller
{
    public function create(): bool
    {
        // create new sitemap object
        $sitemap = App::make("sitemap");

        // add items to the sitemap (url, date, priority, freq)
        $sitemap->add(config('app.url'), '2012-08-25T20:10:00+02:00', '1.0', 'daily');

        // get all posts from db
        $posts = DB::table('posts')->orderBy('created_at', 'desc')->get();

        // add every post to the sitemap
        foreach ($posts as $post) {
            $sitemap->add(config('app.url') . '/post/' . $post->slug, $post->updated_at, '0.9', 'daily');
        }

        // generate your sitemap (format, filename)
        $sitemap->store('xml', 'sitemap');
        // this will generate file mysitemap.xml to your public folder
        return true;
    }
}
