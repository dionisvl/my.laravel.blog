<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use App\Post;
use Auth;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(){
        if (Auth::check()){
            //authirized
        } else {
            //guest
        }
        //$posts = Post::paginate(6);
        $posts = Post::orderBy('posts.created_at','desc')->paginate(20);
        return view('pages.index')->with('posts', $posts);
    }

    public function contacts(){
        return view('pages.contacts');
    }

    public function highlighting($matches, $edge_tag = 'div')
    {
        // $matches[0] -  полное вхождение шаблона
        // $matches[1] - вхождение первой подмаски,
        // заключенной в круглые скобки и так далее...
        return "<$edge_tag style='background:#e0e0e0;'>" . highlight_string($matches[1], 1) . "</$edge_tag>";
        //  return highlight_string($matches[1],1);
    }

    public function show($slug){
        $post = Post::where('slug',$slug)->firstOrFail();
//        /**
//         * 1 Находим в большой строке все теги "<code>"
//         * 2 Вырезаем содержимое и обрабатываем функцией highlight_string и обрамляем своим тегом например "pre" или code
//         * 3 вставляем обратно вместо найденных тегов "<code>"
//         * */
//        //$highlight_pattern = '#<code>((.|\s)+?)</code>#';
//        $post->content = stripslashes(preg_replace_callback('#<code>((.|\s)+?)</code>#', array($this,'highlighting'), $post->content)) ;
        mb_internal_encoding("UTF-8");

        //$post->title = iconv_substr ( $post->title, 0, 45);
        $rText = iconv_substr('Cправочник по тематике программирования на языках PHP, JS.'.$post->title, 0, 100);
        $post->description = $rText;

        return view('pages.show', compact('post'));


    }

    public function tag($slug){
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->paginate(10);
        return view('pages.list', ['posts'  =>  $posts]);
    }

    public function category($slug){
        $category = Category::where('slug',$slug)->firstOrFail();
        $posts = $category->posts()->paginate(10);
        return view('pages.list', ['posts' => $posts]);
    }
}
