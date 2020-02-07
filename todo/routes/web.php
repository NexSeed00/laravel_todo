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

Route::get('/search', 'TaskController@search')->name('task.search');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/mypage', 'UserController@mypage')->name('user.mypage');

    Route::get('/tasks/create', 'TaskController@create')->name('task.create');

    Route::post('/tasks/store', 'TaskController@store')->name('task.store');

    Route::get('/tasks/{task}/edit', 'TaskController@edit')->name('task.edit');

    Route::put('/tasks/{task}/update', 'TaskController@update')->name('task.update');

    Route::delete('/tasks/{task}/delete', 'TaskController@delete')->name('task.delete');

    Route::post('task/{task}/bookmark', 'TaskController@bookmark')->name('task.bookmark');

    Route::post('task/{task}/unbook', 'TaskController@unbook')->name('task.unbook');
});


Auth::routes();
