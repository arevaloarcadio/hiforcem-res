<?php

use Illuminate\Support\Facades\DB;
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
Route::get('order/presupuesto/{id}', 'ItemController@printPresupuesto');
Route::get('order/albaran/{id}', 'ItemController@printAlbaran');
Route::get('order/pedido/{id}', 'ItemController@printPedido');
Route::get('order/invoice/{id}', 'ItemController@printInvoice');

Route::any('{all}', function () {
	return view('app');
})->where(['all' => '.*']);
