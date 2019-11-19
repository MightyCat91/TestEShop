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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('weather', 'WeatherController@show')->name('weather');

Route::group(['prefix' => 'orders'], function () {
    Route::get('', [
        'as' => 'orders', 'uses' => 'OrdersController@show'
    ]);
    Route::group(['prefix' => 'edit/{id}', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('', [
            'as' => 'orders-edit', 'uses' => 'EditOrderController@show'
        ]);
    });
});