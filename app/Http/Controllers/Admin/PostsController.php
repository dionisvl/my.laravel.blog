<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Post\AddPostRequest;
use App\Http\Requests\Admin\Post\UpdatePostRequest;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'DESC')->get();

        return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AddPostRequest $request
     * @return RedirectResponse
     */
    public function store(AddPostRequest $request): RedirectResponse
    {
        $post = Post::add($request->all());
        $post->uploadImage($request->file('image'));
        $post->setCategory($request->get('category_id'));
        $post->setTags($request->get('tags'));
        $post->toggleStatus($request->get('status'));
        $post->toggleFeatured($request->get('is_featured'));

        return redirect()->route('posts.index');
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param int $id
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        $selectedTags = $post->tags->pluck('id')->all();

        return view('admin.posts.edit', compact(
            'categories',
            'tags',
            'post',
            'selectedTags'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdatePostRequest $request, int $id): RedirectResponse
    {
        $post = Post::find($id);
        $post->edit($request->all());
        $post->uploadImage($request->file('image'));
        $post->setCategory($request->get('category_id'));
        $post->setTags($request->get('tags'));
        $post->toggleStatus($request->get('status'));
        $post->toggleFeatured($request->get('is_featured'));

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        Post::find($id)->remove();
        return redirect()->route('posts.index');
    }
}
