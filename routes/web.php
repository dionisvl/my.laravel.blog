<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::group(['middleware' => ['web']], function () {
    Route::get('/post/{slug}', 'HomeController@show')->name('post.show');
});

Route::get('/tag/{slug}', 'HomeController@tag')->name('tag.show');
Route::get('/category/{slug}', [HomeController::class, 'category'])->name('blog.category.show');

Route::get('/privacy/', 'HomeController@privacy');
Route::get('/contacts/', 'HomeController@contacts');
Route::get('/profile', 'ProfileController@index');

Route::post('/subscribe', 'SubsController@subscribe');
Route::get('/verify/{token}', 'SubsController@verify');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', 'ProfileController@index');
    Route::post('/profile', 'ProfileController@store');
    Route::get('/logout', 'AuthController@logout');
});

Route::post('/comment', 'CommentsController@store');

Route::group(['middleware' => ['cors']], function () {
    Route::post('/incoming', 'IncomingsController@store');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', 'AuthController@registerForm');
    Route::post('/register', 'AuthController@register');
    Route::get('/login', 'AuthController@loginForm')->name('login');
    Route::post('/login', 'AuthController@login');
});


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['admin', 'web']], function () {
    Route::get('/', 'DashboardController@index');
    Route::resource('/categories', 'CategoriesController');
    Route::resource('/tags', 'TagsController');
    Route::resource('/users', 'UsersController');
    Route::resource('/posts', 'PostsController');
    Route::get('/comments', 'CommentsController@index');
    Route::get('/comments/toggle/{id}', 'CommentsController@toggle');
    Route::delete('/comments/{id}/destroy', 'CommentsController@destroy')->name('comments.destroy');
    Route::resource('/subscribers', 'SubscribersController');

    Route::resource('/portfolios', 'PortfoliosController');

    Route::resource('/incomings', 'IncomingsController');
    Route::get('/incomings/toggle/{id}', 'IncomingsController@toggle');
    Route::delete('/incomings/{id}/destroy', 'IncomingsController@destroy')->name('incomings.destroy');

    Route::resource('/products', 'ProductsController');

    Route::get('/orders/download', ['as' => 'orders_download', 'uses' => OrdersController::class . '@download']);
    Route::resource('/orders', 'OrdersController');
});

//Route::any('/search',function(){
//    $q = Input::get ( 'q' );
//    $post = Post::where('title','LIKE','%'.$q.'%')->orWhere('description','LIKE','%'.$q.'%')->get();
//    if(count($post) > 0)
//        return view('search')->withDetails($post)->withQuery ( $q );
//    else return view ('search')->withMessage('No Details found. Try to search again !');
//});

Route::any('/search', 'SearchController@index');

Route::group(['prefix' => 'shop', 'middleware' => ['web']], function () {
    Route::get('/', ['as' => 'shop.index', 'uses' => ProductController::class . '@index']);
    //   Route::get('/', 'ProductController@index');
    Route::get('/cart', 'ProductController@showCart')->name('cart.show');
    Route::any('/cart/order', ['as' => 'order_store', 'uses' => OrderController::class . '@store']);
    Route::get('/{slug}', 'ProductController@show')->name('product.show');
    Route::get('/categories/{category}.html', 'CategoryController@show')->name('category.show');

    Route::get('/pages/contacts.html', function () {
        return view('shop.contacts');
    })->name('shop.contacts.show');
    Route::get('/pages/payment.html', function () {
        return view('shop.payment');
    })->name('shop.payment.show');
    Route::get('/pages/food.html', function () {
        return view('shop.food');
    })->name('shop.food.show');
});

Route::post('/postlike/{post_id}', PostLikeController::class . '@toggle');

/**
 * Verb             URI                     Action  Route Name
 * GET              /photos                 index   photos.index
 * GET              /photos/create          create  photos.create
 * POST             /photos                 store   photos.store
 * GET              /photos/{photo}         show    photos.show
 * GET              /photos/{photo}/edit    edit    photos.edit
 * PUT/PATCH        /photos/{photo}         update  photos.update
 * DELETE           /photos/{photo}         destroy photos.destroy
 */
