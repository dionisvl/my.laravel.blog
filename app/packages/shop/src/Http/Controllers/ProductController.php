<?php

namespace Dionisvl\Shop\Http\Controllers;

use App\Http\Controllers\Controller;
use Dionisvl\Shop\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $products = Product::orderBy('products.created_at', 'desc')->paginate(20);
        return view('shop::shop.products')->with(['products' => $products]);
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return Application|Factory|Response|View
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('shop::shop.show')->with(['product' => $product]);
    }

    public function showCart()
    {
        return view('shop::shop.cart');
    }
}
