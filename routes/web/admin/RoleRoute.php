<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'admin'], 'namespace' => 'App\Http\Controllers\Admin\Role'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'RoleController@index'
            ]);
            Route::get('/create', [
                'as' => 'create',
                'uses' => 'RoleController@create'
            ]);
            Route::post('/store', [
                'as' => 'store',
                'uses' => 'RoleController@store'
            ]);
            Route::get('/{role}/edit', [
                'as' => 'edit',
                'uses' => 'RoleController@edit'
            ]);
            Route::put('{role}/update', [
                'as' => 'update',
                'uses' => 'RoleController@update'
            ]);
            Route::delete('{role}/destroy', [
                'as' => 'destroy',
                'uses' => 'RoleController@destroy'
            ]);
        });
        Route::group(['middleware' => ['is.ajax'], 'prefix' => 'roles-ajax', 'as' => 'roles.ajax.'], function () {
            Route::get('/getDatatableData', [
                'as' => 'getDatatableData',
                'uses' => 'RoleAjaxController@getDatatableData'
            ]);
        });
    });
});
