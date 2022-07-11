<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'App\Http\Controllers\User\User'], function () {
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'UserController@index'
            ]);
        });
        Route::group(['middleware' => ['is.ajax'], 'prefix' => 'users-ajax', 'as' => 'users.ajax.'], function () {
            Route::get('/getDatatableData', [
                'as' => 'getDatatableData',
                'uses' => 'UserAjaxController@getDatatableData'
            ]);
        });
    });
});
