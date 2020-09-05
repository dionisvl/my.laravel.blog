<?php

namespace Dionisvl\Shop\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use Dionisvl\Shop\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return Application|Factory|Response|View
     */
    public function show(string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)->get();
        return view('shop::shop.category')->with(['category' => $category, 'products' => $products]);
    }

    public function showCart()
    {
        return view('shop::shop.cart');
    }
}
