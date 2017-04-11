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

Route::get('/', function () {
    return view('welcome');
});

/*users*/
Route::get('user', 'UserController@index');
Route::post('create_user', 'UserController@store');
Route::get('get_user/{id}', 'UserController@edit');
Route::post('update_user','UserController@update');
Route::post('delete_user', 'UserController@delete');

// For RESTFUL api
//Route::get('api/todo', ['uses' => 'UserController@testGet','middleware'=>'restapi']);
Route::post('api/create_user', ['uses' => 'UserController@store','middleware'=>'restapi']);
Route::get('api/get_user/{id}', ['uses' => 'UserController@edit','middleware'=>'restapi']);
Route::post('api/delete_user', ['uses' => 'UserController@delete','middleware'=>'restapi']);
