<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of the routes that are handled
  | by your application. Just tell Laravel the URIs it should respond
  | to using a Closure or controller method. Build something great!
  |
 */

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/logout', function() {
    Auth::logout();
    return redirect('/');
});

Route::get('/test/paypal', 'TestController@paypal');
Route::get('/test/paypal/payment/{status}', 'TestController@payment');

Route::group(['middleware' => 'auth'], function () {

    Route::get('home', 'HomeController@index');

    Route::get('users/datatable', 'UsersController@datatable');
    Route::resource('users', 'UsersController');

    Route::get('products/datatable', 'ProductsController@datatable');
    Route::resource('products', 'ProductsController');

    Route::get('categories/datatable', 'CategoriesController@datatable');
    Route::resource('categories', 'CategoriesController');

    Route::get('si/datatable', 'SalesInvoicesController@datatable');
    Route::resource('si', 'SalesInvoicesController');

    Route::post('file/upload', 'FileController@upload');
});
