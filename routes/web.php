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

// 講師
Route::group(['prefix' => 'kitsuke/masters'], function() {
    // 一覧
    Route::get('/', 'MasterController@index')->name('masters.index');

    // 新規登録
    Route::get('/create', 'MasterController@showCreateForm')->name('masters.create');
    Route::post('/', 'MasterController@create');

});