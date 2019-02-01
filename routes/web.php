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
Route::resource('pradinis', 'TableController');

Route::get('/table', 'TableController@index');
Route::post('getClone/{id}','OrdersController@getClone');
Route::post('getCloneKopinam/{id}','OrdersControllerKopinam@getCloneOrder');
Route::post('getCloneKopinamPost/{id}','PostControllerKopinam@getClonePost');

//paieska posts
Route::post('/posts/search', 'PostsController@search');
Route::post('/table/search', 'PostsController@search');

Route::post('/orders/search', 'OrdersController@searchOrders');
Route::get('/dashboard', 'DashboardController@index');