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

Route::get('/', 'mainController@index')->name('home');
Route::get('home', 'mainController@index');
Route::get('profile', 'profileController@index');
Route::get('view', 'viewController@index');
Route::get('single_view', 'viewController@singleView');
Route::get('/profile/edit/{id}','editProfileController@index');

Route::resource('/profile/edit', 'editProfileController');

Route::post('up_load', 'ImageController@postUpload');
Route::post('/answer','viewController@store')->name('answer');

// Route::post('upload/delete', ['as' => 'upload-remove', 'uses' =>'ImageController@deleteUpload']);


Auth::routes();

