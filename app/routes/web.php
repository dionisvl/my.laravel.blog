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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::group(['middleware' => ['web']], static function () {
    Route::get('/post/{slug}', [PostController::class, 'showBySlug'])->name('post.show');
    Route::get('/post-by-id/{id}', [PostController::class, 'showById'])->name('post.showById');
});

Route::get('/tag/{slug}', 'HomeController@tag')->name('tag.show');
Route::get('/category/{slug}', [HomeController::class, 'category'])->name('blog.category.show');

Route::get('/privacy/', 'HomeController@privacy');
Route::get('/contacts/', 'HomeController@contacts');
Route::get('/profile', 'ProfileController@index');

Route::post('/subscribe', 'SubsController@create')->name('subscribe.create');
Route::get('/verify/{token}', 'SubsController@verify');

Route::group(['middleware' => 'auth'], static function () {
    Route::get('/profile', 'ProfileController@index');
    Route::post('/profile', 'ProfileController@store');
    Route::get('/logout', 'AuthController@logout');
});

Route::post('/comment', 'CommentsController@store');

Route::group(['middleware' => ['cors']], static function () {
    Route::post('/incoming', 'IncomingsController@store');
});

Route::group(['middleware' => 'guest'], static function () {
    Route::get('/register', 'AuthController@registerForm');
    Route::post('/register', 'AuthController@register');
    Route::get('/login', 'AuthController@loginForm')->name('login');
    Route::post('/login', 'AuthController@login');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['admin', 'web']], static function () {
    Route::get('/', 'DashboardController@index');
    Route::resource('/categories', 'CategoriesController')->except('show');
    Route::resource('/tags', 'TagsController')->except('show');
    Route::resource('/users', 'UsersController')->except('show');
    Route::resource('/posts', 'PostsController')->except('show');
    Route::get('/comments', 'CommentsController@index');
    Route::get('/comments/toggle/{id}', 'CommentsController@toggle')->name('admin.comments.toggle');
    Route::delete('/comments/{id}/destroy', 'CommentsController@destroy')->name('admin.comments.destroy');
    Route::resource('/subscribers', 'SubscribersController')
        ->except('show', 'edit', 'update');

    Route::resource('/portfolios', 'PortfoliosController')->except('show');

    Route::resource('/incomings', 'IncomingsController')
        ->except('create', 'store', 'show', 'edit', 'update');
});

Route::post('/search', [SearchController::class, 'index']);

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

//Generate sitemap.xml
Route::get('mysitemap', SitemapController::class . '@create');
