<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'App\Http\Controllers\User\Order'], function () {
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'OrderController@index'
            ]);
            Route::get('/{course:slug}', [
                'as' => 'show',
                'uses' => 'OrderController@show'
            ]);
        });
        Route::group(['middleware' => ['is.ajax'], 'prefix' => 'orders-ajax', 'as' => 'orders.ajax.'], function () {
            Route::get('/getDatatableData', [
                'as' => 'getDatatableData',
                'uses' => 'OrderAjaxController@getDatatableData'
            ]);
        });
    });
});
