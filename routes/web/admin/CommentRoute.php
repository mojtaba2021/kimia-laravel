<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'permission:commentControl'], 'namespace' => 'App\Http\Controllers\Admin\Comment'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'comments', 'as' => 'comments.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'CommentController@index'
            ]);
            Route::post('/store', [
                'as' => 'store',
                'uses' => 'CommentController@store'
            ]);
            Route::get('/show', [
                'as' => 'show',
                'uses' => 'CommentController@show'
            ]);
            Route::match(['put', 'patch'], '{comment}/update', [
                'as' => 'update',
                'uses' => 'CommentController@update'
            ]);
            Route::delete('{comment}/destroy', [
                'as' => 'destroy',
                'uses' => 'CommentController@destroy'
            ]);
        });
        Route::group(['middleware' => ['is.ajax'], 'prefix' => 'comments-ajax', 'as' => 'comments.ajax.'], function () {
            Route::get('/getDatatableData', [
                'as' => 'getDatatableData',
                'uses' => 'CommentAjaxController@getDatatableData'
            ]);
        });
    });
});
