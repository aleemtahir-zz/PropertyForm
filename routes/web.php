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
Route::get('property/autocomplete',[
    'as' => 'autocomplete',
    'uses' => 'PropertyController@autocomplete'
]);
Route::resource('property','PropertyController');
Route::post('updateDevelopmentView', 'DevController@updateView');
Route::get('getDevId', 'DevController@getDevId');
Route::post('updatePropertyView', 'PropertyController@updateProperty');
Route::post('merge',[
    'as' => 'merge',
    'uses' => 'PropertyController@mergeDownload'
]);
Route::post('sendemail',[
    'as' => 'sendemail',
    'uses' => 'DevController@sendEmail'
]);
Route::resource('DeveloperDataFormA','DevController');
Route::resource('DeveloperDataFormB','DevController');
Route::resource('payment','PaymentController');
Route::resource('upload','UploadController');
Route::post('upload/show',[
    'as' => 'upload/show',
    'uses' => 'UploadController@postShow'
]);

Route::get('images/{filename}', function ($filename)
{
    $path = storage_path() . '/app/public/dev_logo/' . $filename;

    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});