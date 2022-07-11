<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web'], 'namespace' => 'App\Http\Controllers\Site\Search'], function () {
    Route::group(['as' => 'site.'], function () {
        Route::group(['middleware' => ['is.ajax'], 'prefix' => 'searches-ajax', 'as' => 'searches.ajax.'], function () {
            Route::get('/getData', [
                'as' => 'getData',
                'uses' => 'SearchAjaxController@getData'
            ]);
        });
    });
});
