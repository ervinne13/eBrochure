<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['middleware' => 'cors'], function () {
    Route::get('/categories', 'CategoriesController@index');
    Route::get('/categories/{categoryId}/products', 'ProductsController@byCategory');
    Route::get('/pay', 'SalesInvoicesController@pay');
    Route::post('/si', 'SalesInvoicesController@store');

    Route::post('/users/register', 'UsersController@store');
    Route::post('/users/login', 'UsersController@login');
});
