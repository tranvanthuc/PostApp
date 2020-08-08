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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'post'], function () { 
    Route::get('/', 'PostController@index')->name('list-post');
    Route::post('/', 'PostController@store')->name('store-post');
    Route::get('/create', 'PostController@create')->name('create-post');
    Route::get('/{post}/edit', 'PostController@edit')->name('edit-post');
    Route::post('/{post}/edit', 'PostController@update')->name('update-post');
    Route::get('/{post}/destroy', 'PostController@destroy')->name('destroy-post');
    Route::get('/{post}/increase-like', 'PostController@increaseLike')->name('increase-like-post');
    Route::get('/{post}/decrease-like', 'PostController@decreaseLike')->name('decrease-like-post');
    Route::get('/{post}', 'PostController@show')->name('detail-post');
    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
