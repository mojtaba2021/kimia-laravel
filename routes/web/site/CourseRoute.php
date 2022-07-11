<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web'], 'namespace' => 'App\Http\Controllers\Site\Course'], function () {
    Route::group(['as' => 'site.'], function () {
        Route::group(['prefix' => 'courses', 'as' => 'courses.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'CourseController@index'
            ]);
            Route::get('/{course:slug}', [
                'as' => 'show',
                'uses' => 'CourseController@show'
            ]);

        });
    });
});
