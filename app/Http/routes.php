<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::controller('/test', 'TestController');
Route::controller('/administration', 'AdministrationController');

Route::group(['middleware' => 'auth'], function () {

    //  Stores & Products
    Route::get('/stores/datatable', 'StoresController@datatable');
    Route::get('/stores/{storeId}/products/datatable', 'StoreProductsController@datatable');
    Route::get('/products/{product}/uom/datatable', 'ProductUOMController@datatable');
    Route::resource('stores', 'StoresController');
    Route::resource('stores.products', 'StoreProductsController');
    Route::resource('products.uom', 'ProductUOMController');

    //  UOM
    Route::get('/uom/datatable', 'UOMController@datatable');
    Route::resource('uom', 'UOMController');

    Route::resource('users', 'UsersController');
});
