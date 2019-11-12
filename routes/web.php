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

Route::get('/', 'HomeController@index');
Route::get('/contacts/', 'HomeController@contacts');

Route::group(['middleware' => ['web']], function () {
    Route::get('/post/{slug}', 'HomeController@show')->name('post.show');
});

Route::get('/tag/{slug}', 'HomeController@tag')->name('tag.show');
Route::get('/category/{slug}', 'HomeController@category')->name('category.show');
Route::post('/subscribe', 'SubsController@subscribe');
Route::get('/verify/{token}', 'SubsController@verify');
Route::get('/privacy/', 'HomeController@privacy');

Route::get('/profile', 'ProfileController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', 'ProfileController@index');
    Route::post('/profile', 'ProfileController@store');
    Route::get('/logout', 'AuthController@logout');

});
Route::post('/comment', 'CommentsController@store');

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
});

//Route::any('/search',function(){
//    $q = Input::get ( 'q' );
//    $post = Post::where('title','LIKE','%'.$q.'%')->orWhere('description','LIKE','%'.$q.'%')->get();
//    if(count($post) > 0)
//        return view('search')->withDetails($post)->withQuery ( $q );
//    else return view ('search')->withMessage('No Details found. Try to search again !');
//});

Route::any('/search', 'SearchController@index');




//index
//create
//store
//edit
//update
//destroy
