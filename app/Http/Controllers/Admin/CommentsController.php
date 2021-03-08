<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::all();

        return view('admin.comments.index', ['comments' => $comments]);
    }

    public function toggle($id): RedirectResponse
    {
        $comment = Comment::find($id);
        $comment->toggleStatus();

        return redirect()->back();
    }

    public function destroy($id): RedirectResponse
    {
        Comment::find($id)->remove();
        return redirect()->back();
    }
}
