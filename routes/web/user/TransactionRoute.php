<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'App\Http\Controllers\User\Transaction'], function () {
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
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
