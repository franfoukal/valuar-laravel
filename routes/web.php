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


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    return view('home');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/product-list', function () {
    return view('product-list');
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
Route::get('profile', function () {
    return view('profile');
});

Route::get('/faq', function () {
    return view('faq');
});
Route::get('/product/{id}', 'ProductController@displayProduct');
Auth::routes();




