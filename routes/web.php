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
    Route::get('/common/signerName', 'AdminController@signerName')->name("admin.common.signerName");
    Route::resource('employees', 'EmployeeController');

    //产品管理
    Route::group(["prefix"=>"products"],function (){
        Route::post('import','ProductController@import')->name("products.import");
        Route::get('export','ProductController@export')->name("products.export");

    });
    Route::resource('products', 'ProductController');

    
    

    //单据管理
    Route::group(["prefix"=>"policies"],function (){
        Route::post('import','PolicyController@import')->name("policies.import");
        Route::get('export','PolicyController@export')->name("policies.export");
        Route::get('renewal/{id}','PolicyController@renewal')->name("policies.renewal");
        Route::get('release/{id}','PolicyController@release')->name("policies.release");
        Route::get('review/{id}','PolicyController@review')->name("policies.review");
        Route::get('transfer/{id}','PolicyController@transfer')->name("policies.transfer");
        Route::post('storeReleaseRecord/{id}','PolicyController@storeReleaseRecord')->name("policies.storeReleaseRecord");
        
        
        
    });
    Route::resource('policies', 'PolicyController');

    //业绩管理
    Route::get('performances/employees', 'PerformanceController@indexByEmployee');
    Route::get('performances/channels', 'PerformanceController@indexByChannel');
    Route::resource('performances', 'PerformanceController');

    //系统管理
    Route::group(["prefix"=>"site"],function(){
        Route::get('settings','SiteController@settings')->name("site.settings");
        Route::post('settings','SiteController@updateSettings')->name("site.updateSettings");
    });
});

//前端
Route::group(["namespace"=>"Front"],function() {
    //登录
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login.view');
    Route::post('login', 'Auth\LoginController@login')->name("login");
    Route::post('logout', 'Auth\LoginController@logout')->name("logout");

    Route::get('/','HomeController@index')->name('home');
    Route::get('{id}/personalPerformance','HomeController@personalPerformance')->name('home.personalPerformance');
    Route::get('{id}/teamPerformance','HomeController@teamPerformance')->name('home.teamPerformance');
    Route::get('{id}/products','HomeController@products')->name('home.products');

});