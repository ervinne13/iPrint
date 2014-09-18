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

Route::auth();
Route::get('/', function () {
    return view('welcome');
});

//  Custom registration
Route::post('/users/register', 'RegistrationController@registerUser');

Route::group(['middleware' => 'api'], function () {
    Route::post('/api/login', 'API\v1\AuthController@login');
    Route::post('/api/files/upload', 'API\v1\FilesController@upload');
});

Route::group(['prefix' => 'api'], function() {
    Route::get('stores', 'StoresController@index');
    Route::get('stores/active', 'StoresController@active');
    Route::get('stores/{storeId}/products', 'StoreProductsController@index');
    Route::get('joborders/{userId}', 'JobOrdersController@ofUser');
    Route::get('joborders/{jobOrderId}/cancel', 'JobOrdersController@cancel');
    
    Route::post('register', 'UsersController@register');
    
});


Route::group(['prefix' => 'api', 'middleware' => 'auth:api'], function() {
    Route::post('joborders', 'JobOrdersController@store');
});

Route::get('/test/dynamic-field', 'TestController@dynamicField');

Route::group(['middleware' => 'auth'], function () {

    Route::controller('/administration', 'AdministrationController');

    //  Stores & Products
    Route::get('/stores/datatable', 'StoresController@datatable');
    Route::get('/stores/{storeId}/products/datatable', 'StoreProductsController@datatable');
    Route::get('/stores/{storeId}/orders/datatable', 'StoreJobOrdersController@datatable');
    Route::get('/stores/{storeId}/orders/datatable/{active}', 'StoreJobOrdersController@datatable');

    Route::get('/stores/{storeId}/salesSummaryReport', 'StoreJobOrdersController@salesSummaryReport');
    Route::get('/stores/{storeId}/orders/active', 'StoreJobOrdersController@activeOrders');
    Route::get('/stores/{storeId}/deactivate', 'StoresController@deactivate');

    Route::get('/products/{product}/uom/datatable', 'ProductUOMController@datatable');

    Route::resource('stores', 'StoresController');
    Route::resource('stores.products', 'StoreProductsController');
    Route::resource('stores.orders', 'StoreJobOrdersController');
    Route::resource('products.uom', 'ProductUOMController');

    //  UOM
    Route::get('/uom/datatable', 'UOMController@datatable');
    Route::resource('uom', 'UOMController');

    Route::get('/users/datatable', 'UsersController@datatable');
    Route::get('/users/dashboard', 'UsersController@dashboard');
    Route::get('/users/{userId}/changepassword', 'UsersController@changepassword');
    Route::post('/users/{userId}/changepassword', 'UsersController@updatePassword');
    Route::get('/users/{userId}/passwordchanged', 'UsersController@changePasswordSuccess');
    Route::resource('users', 'UsersController');

    //  Misc.
    Route::post('/file/upload', 'FileController@upload');
});

//  For Testing
Route::get('/clear-throttles', 'Auth\AuthController@clearThrottle');
Route::controller('/test', 'TestController');
