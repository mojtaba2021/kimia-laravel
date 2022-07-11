<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'permission:messageControl'], 'namespace' => 'App\Http\Controllers\Admin\Message'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'messages', 'as' => 'messages.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'MessageController@index'
            ]);
            Route::delete('{message}/destroy', [
                'as' => 'destroy',
                'uses' => 'MessageController@destroy'
            ]);
        });
        Route::group(['middleware' => ['is.ajax'], 'prefix' => 'messages-ajax', 'as' => 'messages.ajax.'], function () {
            Route::get('/getDatatableData', [
                'as' => 'getDatatableData',
                'uses' => 'MessageAjaxController@getDatatableData'
            ]);
        });
    });
});
