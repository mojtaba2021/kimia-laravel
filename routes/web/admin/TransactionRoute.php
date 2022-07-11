<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'admin'], 'namespace' => 'App\Http\Controllers\Admin\Transaction'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'transactions', 'as' => 'transactions.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'TransactionController@index'
            ]);
        });
        Route::group(['middleware' => ['is.ajax'], 'prefix' => 'transactions-ajax', 'as' => 'transactions.ajax.'], function () {
            Route::get('/getDatatableData', [
                'as' => 'getDatatableData',
                'uses' => 'TransactionAjaxController@getDatatableData'
            ]);
        });
    });
});
