<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'permission:courseControl'], 'namespace' => 'App\Http\Controllers\Admin\Item'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'items', 'as' => 'items.'], function () {
            Route::get('/{course}/create', [
                'as' => 'create',
                'uses' => 'ItemController@create'
            ]);
            Route::post('/store', [
                'as' => 'store',
                'uses' => 'ItemController@store'
            ]);
            Route::get('/{item}/edit', [
                'as' => 'edit',
                'uses' => 'ItemController@edit'
            ]);
            Route::put('{item}/update', [
                'as' => 'update',
                'uses' => 'ItemController@update'
            ]);

            Route::delete('{item}/destroy', [
                'as' => 'destroy',
                'uses' => 'ItemController@destroy'
            ]);
        });
        Route::group(['middleware' => ['is.ajax'], 'prefix' => 'items-ajax', 'as' => 'items.ajax.'], function () {
            Route::post('/item_type', [
                'as' => 'item_type',
                'uses' => 'ItemAjaxController@itemType'
            ]);

            Route::get('/getDatatableData', [
                'as' => 'getDatatableData',
                'uses' => 'ItemAjaxController@getDatatableData'
            ]);

            Route::get('/{item}/getItemDatatableData', [
                'as' => 'getItemDatatableData',
                'uses' => 'ItemAjaxController@getItemDatatableData'
            ]);
        });
    });
});


