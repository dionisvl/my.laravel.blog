<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'message' => 'required',
//            'honeypot' => 'regex:/^$/',//check for field IS empty
            'countMe' => 'required|numeric|min:3'
        ]);

        $honeypot = $request->get('honeypot');
        if (!empty($honeypot)) {
            return redirect()->back()->withErrors(['Error: HPF']);
        }

        $comment = new Comment;
        $comment->text = $request->get('message');
        $comment->post_id = $request->get('post_id');
        if (Auth::check()) {
            $comment->user_id = Auth::id();
        } else {
            $comment->user_id = 777;
        }
        $comment->save();

        return redirect()->back()->with('status', 'Ваш комментарий будет скоро добавлен!');
    }
}
