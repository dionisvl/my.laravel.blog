<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$products = Product::all()->reverse();
        $products = Product::orderBy('updated_at', 'DESC')->get();

//        dd($products);
        return view('admin.products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('title', 'id')->all();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'detail_text' => 'required',
            'image' => 'nullable|image'
        ]);

        $product = Product::add($request->all());
        $product->uploadImage($request->file('preview_picture'), 'preview_picture');
        $product->uploadImage($request->file('detail_picture'), 'detail_picture');
        $product->setCategory($request->get('category_id'));

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::pluck('title', 'id')->all();

        return view('admin.products.edit', compact(
            'categories',
            'product'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'detail_text' => 'required',
            'image' => 'nullable|image'
        ]);

        $product = Product::find($id);
        $product->edit($request->all());
        $product->uploadImage($request->file('preview_picture'), 'preview_picture');
        $product->uploadImage($request->file('detail_picture'), 'detail_picture');
        $product->setCategory($request->get('category_id'));

//        dd($request->get('is_featured'));
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->remove();
        return redirect()->route('products.index');
    }
}
