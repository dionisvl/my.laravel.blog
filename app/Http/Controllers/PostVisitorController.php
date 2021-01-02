<?php

namespace App\Http\Controllers;

use App\Models\PostVisitor;

class PostVisitorController extends Controller
{
    public static function postIsVisited($post_id, $visitor_id): bool
    {
        if (PostVisitor::where('post_id', $post_id)
            ->where('visitor_id', $visitor_id)
            ->exists()
        ) {
            return true;
        }

        return false;
    }

    public static function store($post_id, $visitor_id): void
    {
        PostVisitor::updateOrCreate([
            'post_id' => $post_id,
            'visitor_id' => $visitor_id,
        ]);
    }
}
