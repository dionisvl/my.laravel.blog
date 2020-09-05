<?php

namespace Dionisvl\Shop\Http\Controllers\Admin;

use App\Category;
use Dionisvl\Shop\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $products = Product::orderBy('updated_at', 'DESC')->get();

        return view('shop::admin.products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        $categories = Category::pluck('title', 'id')->all();

        return view('shop::admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
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
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|Response|View
     */
    public function edit(int $id)
    {
        $product = Product::find($id);
        $categories = Category::pluck('title', 'id')->all();

        return view('shop::admin.products.edit', compact(
            'categories',
            'product'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws ValidationException
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

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        Product::find($id)->remove();
        return redirect()->route('products.index');
    }
}
