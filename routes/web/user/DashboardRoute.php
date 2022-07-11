<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'App\Http\Controllers\User'], function () {
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'DashboardController@index'
            ]);
        });
    });
});
