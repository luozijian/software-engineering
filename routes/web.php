<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//后台
Route::group(["prefix"=>"admin"],function(){

    Route::get('login', 'Auth\LoginController@showLoginForm');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name("admin.logout");

    Route::get('/', 'AdminController@index')->name("admin.index");
    Route::get('/show', 'AdminController@show')->name("admin.show");
    Route::get('/test', 'AdminController@test')->name("admin.test");

    //员工管理
    Route::group(["prefix"=>"employees"],function(){
        Route::resource('ranks', 'RankController');
        Route::resource('users', 'UserController');
    });
    Route::get('/common/bossName', 'AdminController@bossName')->name("admin.common.bossName");
    Route::resource('employees', 'EmployeeController');

    //产品管理
    Route::resource('products', 'ProductController');

    //单据管理
    Route::resource('policies', 'PolicyController');

    //业绩管理
    Route::get('performances/employees', 'PerformanceController@indexByEmployee');
    Route::resource('performances', 'PerformanceController');

});
