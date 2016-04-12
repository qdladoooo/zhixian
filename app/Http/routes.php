<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::any('/user/login', 'UserController@login');
Route::any('/user/logout', 'UserController@logout');
//
Route::group(['middleware' => 'auth.base'], function () {
    //用户系统
    Route::controller('user', 'UserController');
    Route::controller('disease', 'DiseaseController');
});


