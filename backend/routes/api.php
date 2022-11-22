<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/products', 'App\Http\Controllers\api\DrugController@index')->name('product.index');
Route::get('/products/{id}', 'App\Http\Controllers\api\DrugController@show')->name('product.show');
Route::group(['prefix'=>'products'], function() {
    Route::get('/categories/{id}', 'App\Http\Controllers\api\CategoryController@show')->name('category.show');
    
});
Route::get('/categories', 'App\Http\Controllers\api\CategoryController@index')->name('category.index');

Route::group(['prefix'=>'users'], function () {
    Route::post('/login', 'App\Http\Controllers\api\UserController@login')->name('login.api');
    Route::post('/register','App\Http\Controllers\api\UserController@register')->name('register.api');
    Route::post('/logout', 'App\Http\Controllers\api\UserController@logout')->name('logout.api');
});

Route::middleware('auth.login')->group(function () {
    Route::get('/orders', 'App\Http\Controllers\api\OrderController@index')->name('order.index');
    Route::get('/orders/{id}', 'App\Http\Controllers\api\OrderController@show')->name('order.show');
    Route::post('/orders/{id}', 'App\Http\Controllers\api\OrderController@update')->name('order.update');
    // Route::resource('/orders', OrderController::class);
});

Route::post('/orders', 'App\Http\Controllers\api\OrderController@store')->name('order.store');

// Route::controller(App\Http\Controllers\api\OrderController::class)->group(function () {
//     // Route::get('/orders', 'App\Http\Controllers\api\OrderController@index')->name('product.index');
//     Route::get('', 'index');
// });