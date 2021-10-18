<?php

use Illuminate\Support\Facades\Route;
Route::get('/admin/login', 'Admin\AuthController@loginPage')->name('admin.login');

Route::post('loginAdmin', 'Admin\AuthController@login');

Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'namespace' => 'Admin'], function () {

    Route::get('/dashboard', 'HomeController@index')->name('admin.dashboard');

    Route::get('logout', 'AuthController@logout')->name('logout');
    Route::resource('task', 'TaskController');
    Route::resource('user', 'UserController');
    Route::post('updateTaskStatus', 'TaskController@updateStatus')->name('updateTaskStatus');

});
Route::get('/{path}', 'Web\HomeController@index')->where('path', '.*');
