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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('profile')->group(function () {
    Route::get('/profiles','ProfileController@index');
    Route::post('/store','ProfileController@store');
    Route::post('/destroy/{id}','ProfileController@destroy');
    Route::post('/show/{id}','ProfileController@show');
    Route::post('/update/{id}','ProfileController@update');
});
Route::prefix('vendor')->group(function () {
    Route::get('/vendors','VendorController@index');
    Route::post('/store','VendorController@store');
    Route::post('/destroy/{id}','VendorController@destroy');
    Route::post('/show/{id}','VendorController@show');
    Route::post('/update/{id}','VendorController@update');
});