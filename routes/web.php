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
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Order;
use Illuminate\Support\Facades\Auth;

Route::get('/', 'ProductController@bestSellers')->name('home');

Route::get('/home', 'ProductController@bestSellers') ->name('home');

Route::get('/contact', function () {
    return view('contact');
});
Route::get('/cart', function () {
    return view('cart');
});
Route::post('/voucher/valid', 'VoucherController@isValid');

Route::post('/cart/add', 'ProductController@addToCart');
Route::get('/cart/get', 'ProductController@getCart');
Route::post('/cart/delete', 'ProductController@deleteFromCart');
Route::post('/cart/refresh', 'ProductController@refreshCart');
Route::get('/deleteCart', 'ProductController@deleteCart');


Route::middleware(['auth'])->group(function(){
    
    Route::get('/profile', function () {
        return view('profile');
    });
    Route::get('/checkout', 'UserController@order')->name('order');
    Route::post('/checkout/cotizarEnvio', 'OrderController@cotizarEnvio');

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
    Route::get('/profile/orders', function () {
        return view('partials.profile.orders');
    });
    Route::post('/profile/user/edit-photo', 'PhotoController@store');
    
    Route::resource('/profile/location', 'LocationController');

    Route::post('/order', 'OrderController@createOrderML');
    Route::get('/orders/get', 'OrderController@getUserOrders');

    Route::get('/paymentResponse', 'OrderController@getPaymentResponse')->name('payment_response');


});

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/product/{id}', 'ProductController@displayProduct')->where('id', '[0-9]+');

Route::get('/products/filter/{filter}', 'ProductController@filter')->where('filter', '[A-Za-z]+');

Route::get('/products/filter/{price_range}', 'ProductController@filter')->where('price_range', '[0-9]+_[0-9]+');

Route::get('products/orderBy/{orderBy}', 'ProductController@orderBy')->where('orderby', '[A-Za-z]+');

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

Route::post('/user/{id}/edit', 'UserController@editUser')->middleware('auth');

// PARA DEBUGEAR: 

Route::get('/dd', function() {
    return dd(Auth::user());
});
Route::get('/ddproduct/{id}', function($id){
    return dd(Product::find($id));
});
Route::get('/ddsells', function(){
    return dd(json_decode(Order::all(), true));
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

    // VOUCHER

    Route::get('/admin/vouchers', function(){
        return view('admin.vouchers');
    });
    
    Route::resource('/admin/voucher', 'VoucherController');

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

Route::get('/email-check/{email}', 'Auth\RegisterController@emailCheck');

Route::post('/login-check', 'Auth\LoginController@checkLogin');