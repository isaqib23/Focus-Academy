<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('classes')->group(function () {
    Route::get('/all', 'ClassesController@index')->name('classes.all');
    Route::post('/create', 'ClassesController@store')->name('classes.create');
    Route::get('/getClassById/{id}', 'ClassesController@edit')->name('classes.create');
});

Route::prefix('students')->group(function () {
    Route::get('/all', 'StudentsController@index')->name('classes.all');
    Route::post('/create', 'StudentsController@store')->name('classes.create');
    Route::get('/getStudentById/{id}', 'StudentsController@edit')->name('classes.create');
});
