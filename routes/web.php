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

Route::resource('property','PropertyController');
Route::post('updateView', 'DevController@updateView');
//Route::get('development', 'DevController@index');
//Route::post('development/store', 'DevController@store');
Route::resource('development','DevController');
Route::resource('payment','PaymentController');
Route::resource('upload','UploadController');
Route::get('test', 'UploadController@test');
