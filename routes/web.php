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
Route::post('updateDevelopmentView', 'DevController@updateView');
Route::post('updatePropertyView', 'PropertyController@updateProperty');
Route::post('merge',[
    'as' => 'merge',
    'uses' => 'PropertyController@mergeDownload'
]);
Route::post('sendemail',[
    'as' => 'sendemail',
    'uses' => 'DevController@sendEmail'
]);
Route::resource('development','DevController');
Route::resource('payment','PaymentController');
Route::resource('upload','UploadController');
