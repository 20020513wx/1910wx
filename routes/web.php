<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//主页
Route::get('admin/index','Admin\MeController@index');

//注册登录
Route::get('/','Admin\RegController@create');
Route::post('admin/regDo','Admin\RegController@store');
Route::get('admin/login','Admin\LoginController@login');
Route::post('admin/loginDo','Admin\LoginController@loginDo');


Route::prefix("/admin")->middleware("isLogin")->group(function(){
    //个人中心
    Route::get('user/index','Admin\UserController@index');
});
Route::get('test','Admin\LoginController@test');
