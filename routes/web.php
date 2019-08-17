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

Route::get('/', 'HomeController@index');
Route::get('/search', 'PostController@search');
Route::delete('/deleteAll', 'PostController@deleteAll');
Route::get('/crud', 'CrudController@create')->name('ajax');
Route::get('/post', 'PostController@index')->name('post');

Route::resource('posts', 'PostController');
Route::resource('cruds', 'CrudController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/verification/{token}', 'Auth\RegisterController@verification');
Route::get('/file', 'FileController@index')->name('viewFile');
Route::get('/file/upload', 'FileController@create')->name('makeFile');
Route::post('/file/upload', 'FileController@store')->name('uploadFile');
Route::delete('/file/{delete}', 'FileController@destroy')->name('deleteFile');
Route::get('/file/download/{id}', 'FileController@show')->name('downloadFile');
Route::get('/file/email/{id}', 'FileController@edit')->name('emailFile');
Route::post('/file/dropzone', 'FileController@dropzone')->name('dropzone');