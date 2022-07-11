<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'permission:courseControl'], 'namespace' => 'App\Http\Controllers\Admin\Course'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'courses', 'as' => 'courses.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'CourseController@index'
            ]);
            Route::get('/create', [
                'as' => 'create',
                'uses' => 'CourseController@create'
            ]);
            Route::post('/store', [
                'as' => 'store',
                'uses' => 'CourseController@store'
            ]);
            Route::get('/show/{course}/item/{item?}', [
                'as' => 'show',
                'uses' => 'CourseController@show'
            ]);
            Route::get('/{course}/edit', [
                'as' => 'edit',
                'uses' => 'CourseController@edit'
            ]);
            Route::put('{course}/update', [
                'as' => 'update',
                'uses' => 'CourseController@update'
            ]);
            Route::delete('{course}/destroy', [
                'as' => 'destroy',
                'uses' => 'CourseController@destroy'
            ]);
        });
        Route::group(['middleware' => ['is.ajax'], 'prefix' => 'courses-ajax', 'as' => 'courses.ajax.'], function () {
            Route::get('/getDatatableData', [
                'as' => 'getDatatableData',
                'uses' => 'CourseAjaxController@getDatatableData'
            ]);
            Route::get('/{course}/getItemDatatableData', [
                'as' => 'getItemDatatableData',
                'uses' => 'CourseAjaxController@getItemDatatableData'
            ]);
        });
    });
});
