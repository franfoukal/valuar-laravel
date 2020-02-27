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

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

Route::get('/', 'ProductController@bestSellers');

Route::get('/home', 'ProductController@bestSellers');

Route::get('/contact', function () {
    return view('contact');
});
Route::get('/cart', function () {
    return view('cart');
});

Route::get('profile', 'PhotoController@profilePhoto');

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/product/{id}', 'ProductController@displayProduct');

Route::get('/products/filter/{filter}', 'ProductController@filter');

Auth::routes();

Route::get('/products', 'ProductController@productList');


// PARA DEBUGEAR: 

Route::get('/dd', function() {
    return dd(Auth::user());
});

// ADMIN

Route::get('/admin/products', 'ProductController@adminProducts')->middleware('admin');

Route::post('/admin/products','ProductController@adminProducts')->middleware('admin');

Route::get('/admin', 'AdminController@index')->middleware('admin');

Route::get('/admin/users', 'AdminController@users')->middleware('admin');

Route::get('/admin/sells', 'AdminController@sells')->middleware('admin');

