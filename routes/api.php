<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::post('login', 'Auth\AuthController@login');
    Route::post('register', 'Auth\AuthController@register');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('user', 'UserController@profile');
        Route::patch('user', 'UserController@updateProfile');
        Route::post('user/create', 'UserController@create')->middleware('admin');
        Route::post('user/verify', 'UserController@verify');
    });
});
