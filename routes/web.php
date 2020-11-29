<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'VideoUploadersController@index')->name('home');
Route::post('/upload-file', 'VideoUploadersController@fileUpload')->name('fileUpload');
Route::get('play_video/{id}', 'VideoUploadersController@getVideoById')->name('play_video');
