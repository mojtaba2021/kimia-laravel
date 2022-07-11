<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'App\Http\Controllers\Admin\Sitemap'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'sitemaps', 'as' => 'sitemaps.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'SitemapController@index'
            ]);
            Route::get('/generate', [
                'as' => 'generate',
                'uses' => 'SitemapController@generate'
            ]);
        });
    });
});
