<?php

use Dionisvl\Shop\Http\Controllers\CategoryController;
use Dionisvl\Shop\Http\Controllers\Admin\OrdersController;
use Dionisvl\Shop\Http\Controllers\Admin\ProductsController;
use Dionisvl\Shop\Http\Controllers\OrderController;
use \Dionisvl\Shop\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'shop', 'middleware' => ['web']], function () {
    Route::get('/', ['as' => 'shop.index', 'uses' => ProductController::class . '@index']);
    Route::get('/cart', [ProductController::class, 'showCart'])->name('cart.show');
    Route::any('/cart/order', ['as' => 'order_store', 'uses' => OrderController::class . '@store']);
    Route::get('/{slug}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/categories/{category}.html', [CategoryController::class, 'show'])->name('shop.category.show');

    Route::get('/pages/contacts.html', function () {
        return view('shop::shop.contacts');
    })->name('shop.contacts.show');
    Route::get('/pages/payment.html', function () {
        return view('shop::shop.payment');
    })->name('shop.payment.show');
    Route::get('/pages/food.html', function () {
        return view('shop::shop.food');
    })->name('shop.food.show');
});

Route::group(['prefix' => 'admin/shop', 'middleware' => ['web', 'admin']], function () {
    Route::resource('/products', ProductsController::class)
        ->except(['show']);
    Route::get('/orders/download', ['as' => 'orders_download', 'uses' => OrdersController::class . '@downloadExcelOrdersList']);
    Route::resource('/orders', OrdersController::class)
        ->except(['show']);
});
