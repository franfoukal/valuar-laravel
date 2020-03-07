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

use App\Product;

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

Route::post('/profile-edit', 'PhotoController@store');

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
Route::get('/ddproduct/{id}', function($id){
    return dd(Product::find($id));
});

// ADMIN

Route::middleware(['admin'])->group(function(){
    Route::get('/admin/products', 'ProductController@adminProducts');

    Route::post('/admin/products','ProductController@adminProducts');

    Route::get('/admin/edit-product/{id}', 'ProductController@getEditProduct');

    Route::post('/admin/edit-product/{id}', 'ProductController@editProduct');

    Route::get('/admin/add-product', 'ProductController@getAddProduct');

    Route::post('/admin/add-product', 'ProductController@addProduct');

    Route::get('/admin', 'AdminController@index');

    Route::get('/admin/users', 'AdminController@users');

    Route::get('/admin/sells', 'AdminController@sells');

    Route::get('/admin/order/{id}', 'AdminController@getOrder');

    Route::get('/admin/edit-user/{id}', 'AdminController@getEditUsers');

    Route::post('/admin/edit-user/{id}', 'AdminController@editUsers');

    Route::get('/admin/add-user', 'AdminController@getAddUser');

    Route::post('/admin/add-user', 'AdminController@addUser');

    /* Por cuestiones tecnicas esto está por get pero tendria que ir por post    */
    Route::get('/admin/delete-photo/{path}', 'PhotoController@deletePhoto');

    Route::get('admin/delete-profile-photos/{user}', 'PhotoController@deleteProfilePhotos');
});

Route::get('/products/search', 'ProductController@search');

