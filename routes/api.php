<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('authenticate', 'AuthenticateController@authenticate');

Route::group(['middleware' => 'jwt.auth'], function()
{
    Route::get('user', 'UserController@show');
    Route::get('user/read/{id}', 'UserController@read');
    Route::post('user/remove/{id}', 'UserController@destroy');
    Route::get('user/comercials', 'UserController@getComercials');
    Route::get('user/me', 'UserController@authUser');
    Route::post('user/add', 'UserController@store');
    Route::post('user/profile/update', 'UserController@updateProfile');
    Route::post('user/password/update', 'UserController@updatePassword');
    Route::post('user/discount/store', 'UserController@storeDiscount');
    Route::post('user/discount/remove/{id}', 'UserController@delDiscount');
    Route::get('users', 'UserController@index');
    Route::post('users/search', 'UserController@search');

    Route::resource('categories','CategoryController');
    Route::get('categories/list/{id?}', 'CategoryController@getCategories');

    Route::post('order/store', 'OrderController@store');
    Route::post('order/update/{id}', 'OrderController@update');
    Route::post('order/remove/{id}', 'OrderController@destroy');
    Route::get('order/process/{id}','OrderController@process');
    Route::get('order/presupuesto/{id}','OrderController@presupuesto');
    Route::get('order/pedido/{id}','OrderController@pedido');
    Route::get('order/albaran/{id}','OrderController@albaran');
    Route::get('order/invoice/{id}','OrderController@invoice');
    Route::get('orders','OrderController@index');
    Route::get('ordersIndex','OrderController@ordersIndex');
    Route::get('order/number/{id}','OrderController@read');

    Route::post('ship/update/{id}', 'ShipController@update');
    Route::post('ship/remove/{id}', 'ShipController@destroy');
    Route::post('ship/store', 'ShipController@store');
    Route::post('ships/getWeights', 'ShipController@getWeights');
    Route::get('ships','ShipController@index');
    Route::get('ship/number/{id}','ShipController@read');

    Route::resource('products','ProductController');
    Route::get('products/list/{id?}', 'ProductController@getProducts');
    Route::get('product/all', 'ProductController@getAllProducts');
    Route::post('products/size/{id}/{size}/{qty}/{order?}/{user?}', 'ProductController@getBySize');
    Route::get('product/read/{id}', 'ProductController@read');
    Route::post('product/add', 'ProductController@add');
    Route::post('product/update', 'ProductController@update');


    Route::resource('items','ItemController');
    Route::get('items/order/{id}','ItemController@itemsByOrder');
    Route::get('items/user/{id}','ItemController@itemsByUser');
    Route::post('items/stats','ItemController@stats');
    //Route::get('order/print/{id}','ItemController@printOrder');
    Route::post('items/delete/{id}','ItemController@destroy');
    Route::post('items/edit/{id}','ItemController@edit');


});


