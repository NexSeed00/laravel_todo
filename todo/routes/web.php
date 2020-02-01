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

use App\Http\Controllers\TaskController;

Route::get('/', 'TaskController@index')->name('task.index');

Route::get('/tasks/create', 'TaskController@create')->name('task.create');

Route::post('/tasks/store', 'TaskController@store')->name('task.store');

Route::get('/tasks/{id}/edit', 'TaskController@edit')->name('task.edit');

