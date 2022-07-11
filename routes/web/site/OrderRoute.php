<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'App\Http\Controllers\Site\Order'], function () {
    Route::group(['as' => 'site.'], function () {
        Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
            Route::post('/', [
                'as' => 'request',
                'uses' => 'OrderController@request'
            ]);
            Route::get('/callback', [
                'as' => 'callback',
                'uses' => 'OrderController@callback'
            ]);
        });
    });
});
