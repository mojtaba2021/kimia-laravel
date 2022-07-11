<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'permission:educationControl'], 'namespace' => 'App\Http\Controllers\Admin\EducationalVideo'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'educationalvideos', 'as' => 'educationalvideos.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'EducationalVideoController@index'
            ]);
            Route::get('/create', [
                'as' => 'create',
                'uses' => 'EducationalVideoController@create'
            ]);
            Route::post('/store', [
                'as' => 'store',
                'uses' => 'EducationalVideoController@store'
            ]);
            Route::get('/{educational}/edit', [
                'as' => 'edit',
                'uses' => 'EducationalVideoController@edit'
            ]);
            Route::put('{educational}/update', [
                'as' => 'update',
                'uses' => 'EducationalVideoController@update'
            ]);
            Route::delete('{educational}/destroy', [
                'as' => 'destroy',
                'uses' => 'EducationalVideoController@destroy'
            ]);
        });
        Route::group(['middleware' => ['is.ajax'], 'prefix' => 'educationalvideos-ajax', 'as' => 'educationalvideos.ajax.'], function () {

            Route::get('/getDatatableData', [
                'as' => 'getDatatableData',
                'uses' => 'EducationalVideoAjaxController@getDatatableData'
            ]);
        });
    });
});
