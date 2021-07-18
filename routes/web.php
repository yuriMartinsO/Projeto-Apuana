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

Route::get('/', 'LogController@index')->name('logs');
Route::get('/log', 'LogController@getAll')->name('getAll');
Route::post('/log', 'LogController@create')->name('createLog');
Route::get('/search', 'LogController@search')->name('searchLog');
Route::get('/indexLogs', 'LogController@indexLogs')->name('indexLog');