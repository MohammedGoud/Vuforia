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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('admin/projects', 'Admin\Projects');
Route::resource('admin/targets', 'Admin\Targets');
Route::resource('admin/markers', 'Admin\Markers');
Route::resource('admin/users', 'Admin\Users');
Route::resource('admin/logs', 'Admin\Logs');


Route::get('admin/home', 'Admin\Home@index' );

Route::get('admin/del_model', 'Admin\Markers@del_model' );
Route::get('admin/home', 'Admin\Home@index' );
Route::get('admin/login', 'Admin\Login@index' );
Route::post('admin/validenter', 'Admin\Login@validenter' );
Route::get('admin/logout', 'Admin\Login@logout' );