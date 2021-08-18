<?php

use Illuminate\Support\Facades\Route;

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

function renderRoute($url, $controller)
{
    Route::get('', $controller . '@index')->name('index');
    Route::get('create', $controller . '@create')->name('create');
    Route::post('store', $controller . '@store')->name('store');

    Route::get('{' . $url . '}', $controller . '@show')->name('show');

    Route::get('edit/{' . $url . '}', $controller . '@edit')->name('edit');

    Route::post('update/{' . $url . '}', $controller . '@update')->name('update');

    Route::post('detele/{' . $url . '}', $controller . '@delete')->name('delete');
}


Route::get('', 'ProductController@index')->name('root');

Route::get('product/addToCart/{id}', 'ProductController@addProductToCart')->name('addToCart');
Route::post('product/addToCart/{id}', 'ProductController@addProductToCart')->name('addToCart');

Route::get('product/incr/{id}', 'ProductController@incrSingleProduct')->name('incrToCart');

Route::get('product/decr/{id}', 'ProductController@decrSingleProduct')->name('decrToCart');

Route::post('product/createOrder/', 'ProductController@createOrder')->name('createOrder');

Route::get('product/checkoutProduct/', 'ProductController@checkoutProduct')->name('checkoutProduct');

Route::get('payment/paymentpage', 'Payment\PaymentController@showPaymentPage')->name('payment.index');

Route::post('payment/pay', 'Payment\PaymentController@pay')->name('payment.store');

Route::get('cart', 'ProductController@showCart')->name('cart');
Route::get('order', 'OrderController@index')->name('order');
Route::get('order/{id}', 'OrderController@show')->name('order.show');
Route::get('product/{product}', 'ProductController@show')->name('product.show');
Route::get('cart/delete/{id}', 'ProductController@deleteCart')->name('cart.delete');

Route::get('register', 'RegisterController@create')->middleware('guest');
Route::post('register', 'RegisterController@store');
Route::post('logout', 'SessionController@destroy');
Route::get('login', 'SessionController@create')->middleware('guest');
Route::post('login', 'SessionController@store')->middleware('guest');
Route::get('logout', 'SessionController@destroy')->middleware('auth');

Route::post('product/{product}/comment', 'CommentController@store')->name('product.comment.store');

Route::get('product/category/{name?}', 'ProductFilterController@category')->name('product.category.show');
Route::get('product/brand/{name?}', 'ProductFilterController@brand')->name('product.brand.show');

Route::get('contact', function () {
    return view('contacts');
});
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin'
], function () {
    Route::group([
        'prefix' => 'products',
        'as' => 'products.'
    ], function () {
        renderRoute('product', 'ProductController');
        Route::post('{name?}', 'ProductController@search')->name('search');
        Route::post('order/changeStatus/{id}', 'ProductController@changeStatus')->name('changeStatus');
    });
    Route::group([
        'prefix' => 'users',
        'as' => 'users.',
    ], function () {
        renderRoute('user', 'UserController');
        Route::post('status/{user}', 'UserController@changeStatus')->name('status');
        Route::post('{name?}', 'UserController@search')->name('search');
    });
    Route::group([
        'prefix' => 'comments',
        'as' => 'comments.'
    ], function () {
        renderRoute('comment', 'CommentController');
    });
    Route::group([
        'prefix' => 'orders',
        'as' => 'orders.'
    ], function () {
        renderRoute('order', 'OrderController');
    });
});



Route::fallback(function () {
    return abort(404);
});

/**
 * TODO list : 
 * comment,product with categories and have many images done
 * search done
 * manage user done 
 * checkout done
 * refactor web route
 * refactor db
 * refactor controller
 */
