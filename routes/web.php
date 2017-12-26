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

Route::get('/', function () {
    return view('pradinis');
});

if (request()->has('kaina')) {
	$posts=App\Post::where('kaina', request('kaina'))->paginate(5);
} else {
	$posts=App\Post::paginate(5);
}

Route::get('/', function () {
	$posts=App\Post::paginate(5);
    return view('posts')->with('posts', $posts);
});

Route::get('/', function () {
    return view('orders');
});

Route::get('/', 'TableController@index');

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');

Route::resource('posts', 'PostsController');
Route::resource('orders', 'OrdersController');
Route::resource('ordersp', 'OrdersControllerProduct');
Route::resource('products', 'ProductController');


Route::resource('pradinis', 'TableController');

//Auth::routes();

Route::get('/table', 'TableController@index');
//Route::post('/table', 'OrdersController@getClone');
Route::post('getClone/{id}','ProductController@getClone');
Route::post('getCloneProduct/{id}','OrdersControllerProduct@getClone');
Route::post('getClone/{id}','OrdersController@getClone');
Route::post('/products/getClone/{id}','ProductController@getClone');


//Route::get('/orders', 'OrdersController@store');

//paieska posts
Route::get('datatable', ['uses'=>'PostController@index']);
Route::get('datatable/getposts', ['as'=>'datatable.getposts','uses'=>'PostController@getPosts']);
Route::post('/posts/search', 'PostsController@search');
Route::post('/table/search', 'PostsController@search');

Route::post('/orders/search', 'OrdersController@searchOrders');
  Route::post('/ordersp/search', 'OrdersControllerProduct@search');
//Route::post('/ordersp/search', 'OrdersControllerProduct@search');
Route::post('/products/ieskau', 'ProductController@search');



//paieska products
Route::get('kita', 'ProductController@index');
//Route::get('products/{id}/edit', 'ProductController@update');




Route::post('/ieskau', 'ProductController@search');
Route::get('/ieskau', 'ProductController@index');

//valdymas products
Route::resource('products', 'SearchPostsController');

Route::get('/dashboard', 'DashboardController@index');