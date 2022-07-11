<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web'], 'namespace' => 'App\Http\Controllers\Site\Message'], function () {
    Route::group(['prefix' => 'site', 'as' => 'site.'], function () {
        Route::group(['prefix' => 'messages', 'as' => 'messages.'], function () {
            Route::post('/', [
                'as' => 'store',
                'uses' => 'MessageController@store'
            ]);
        });
    });
});
