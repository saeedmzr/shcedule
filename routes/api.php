<?php

use Illuminate\Support\Facades\Route;

Route::namespace ('Api')->group(function () {
    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
    Route::post('user', 'UserController@user')->middleware('auth:api');
    Route::post('getEmployees', 'TaskController@getEmployees')->middleware('auth:api');
    Route::post('changeDate', 'TaskController@changeDate')->middleware('auth:api');
    Route::post('submitTask', 'TaskController@submitTask')->middleware('auth:api');

});