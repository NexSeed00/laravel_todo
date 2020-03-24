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

Route::get('/', 'DiaryController@index')->name('diary.index');

Route::get('diaries/create', 'DiaryController@create')->name('diary.create');

Route::post('diaries', 'DiaryController@store')->name('diary.store');

Route::delete('diaries/{diary}', 'DiaryController@destroy')->name('diary.destroy');

Route::get('diaries/{diary}/edit', 'DiaryController@edit')->name('diary.edit');
