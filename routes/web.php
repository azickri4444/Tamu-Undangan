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

Route::get('/', 'TamuController@index');
Route::get('/create', 'TamuController@create');
Route::post('/store', 'TamuController@store');
Route::get('/edit/{id}', 'TamuController@edit');
Route::post('/update/{id}', 'TamuController@update');
Route::get('/delete/{id}', 'TamuController@delete');
Route::get('/export-tamu', 'TamuController@export');
Route::post('/import-tamu', 'TamuController@import');