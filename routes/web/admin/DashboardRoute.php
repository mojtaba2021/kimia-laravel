<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'check_login'], 'namespace' => 'App\Http\Controllers\Admin\Dashboard'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'DashboardController@index'
            ]);
        });
    });
});
