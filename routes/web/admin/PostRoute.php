<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'permission:postControl'], 'namespace' => 'App\Http\Controllers\Admin\Post'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'PostController@index'
            ]);
            Route::get('/create', [
                'as' => 'create',
                'uses' => 'PostController@create'
            ]);
            Route::post('/store', [
                'as' => 'store',
                'uses' => 'PostController@store'
            ]);
            Route::get('/{post}/edit', [
                'as' => 'edit',
                'uses' => 'PostController@edit'
            ]);
            Route::put('{post}/update', [
                'as' => 'update',
                'uses' => 'PostController@update'
            ]);
            Route::delete('{post}/destroy', [
                'as' => 'destroy',
                'uses' => 'PostController@destroy'
            ]);
        });
        Route::group(['middleware' => ['is.ajax'], 'prefix' => 'posts-ajax', 'as' => 'posts.ajax.'], function () {
            Route::get('/getDatatableData', [
                'as' => 'getDatatableData',
                'uses' => 'PostAjaxController@getDatatableData'
            ]);
        });
    });
});
