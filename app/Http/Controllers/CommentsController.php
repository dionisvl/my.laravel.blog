<?php

namespace App\Http\Controllers;

use Auth;
use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'message'	=>	'required'
        ]);

        $comment = new Comment;
        $comment->text = $request->get('message');
        $comment->post_id = $request->get('post_id');
        if(Auth::check()){
            $comment->user_id = Auth::id();
        } else
            $comment->user_id = 777;
        $comment->save();

        return redirect()->back()->with('status', 'Ваш комментарий будет скоро добавлен!');
    }
}
