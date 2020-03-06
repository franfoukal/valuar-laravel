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


Route::get('/profile', function () {
    return view('profile');
});
Route::get('/profile/favs', function () {
    return view('partials.profile.favourites');
});
Route::get('/profile/address', function () {
    return view('partials.profile.address');
});
Route::get('/profile/address-aut', function () {
    return view('partials.profile.address-autocomplete');
});
Route::get('/profile/user', function () {
    return view('partials.profile.user-config');
});


Route::get('/faq', function () {
    return view('faq');
});

Route::get('/product/{id}', 'ProductController@displayProduct');

Route::get('/products/filter/{filter}', 'ProductController@filter');

Auth::routes();

Route::get('/products', 'ProductController@productList');
Route::post('/product/fav/{id}', function($id){
    Auth::user()->favourites()->attach($id);
});
Route::delete('/product/fav/{id}', function ($id) {
    Auth::user()->favourites()->detach($id);
});

Route::post('/product/isfav/{prod}/{user}', 'ProductController@isFavBy');
/*
Route::get('/profile-edit', function(){   <<--- Llegó roto con el pull :s 
*/

// PARA DEBUGEAR: 

Route::get('/dd', function() {
    return dd(Auth::user());
});

Route::post('/profile-edit', 'PhotoController@store');

// ADMIN

Route::get('/admin/products', 'ProductController@adminProducts')->middleware('admin');

Route::post('/admin/products','ProductController@adminProducts')->middleware('admin');

Route::get('/admin/edit-product/{id}', 'ProductController@getEditProduct')->middleware('admin');

Route::post('/admin/edit-product/{id}', 'ProductController@editProduct')->middleware('admin');

Route::get('/admin/add-product', 'ProductController@getAddProduct')->middleware('admin');

Route::post('/admin/add-product', 'ProductController@addProduct')->middleware('admin');

Route::get('/admin', 'AdminController@index')->middleware('admin');

Route::get('/admin/users', 'AdminController@users')->middleware('admin');

Route::get('/admin/sells', 'AdminController@sells')->middleware('admin');

Route::get('/admin/edit-user/{id}', 'AdminController@getEditUsers')->middleware('admin');

Route::post('/admin/edit-user/{id}', 'AdminController@editUsers')->middleware('admin');

Route::get('/admin/add-user', 'AdminController@getAddUser')->middleware('admin');

Route::post('/admin/add-user', 'AdminController@addUser')->middleware('admin');

