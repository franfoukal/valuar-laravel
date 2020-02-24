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
/*Route::get('login', function () {
    return view('login');
});
Route::get('register', function () {
    return view('register');
});*/
Route::get('profile', 'PhotoController@profilePhoto');

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/product/{id}', 'ProductController@displayProduct');

Route::get('/products/filter/{filter}', 'ProductController@filter');


Auth::routes();

Route::get('/products', 'ProductController@productList');

<<<<<<< HEAD
Route::get('/profile-edit', function(){

    return view('profile-edit');
});
Route::post('/profile-edit', 'PhotoController@store');
=======

// ADMIN

Route::get('/admin/products', 'ProductController@adminProducts');
Route::post('/admin/products','ProductController@adminProducts');
>>>>>>> 1549bf9a6a17969ab65513398d737cba42de02d8
