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


Auth::routes();

Route::group(['middleware' => ['auth']], function() {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/review', 'HomeController@review')->name('review');
    Route::get('/brteta', 'HomeController@brteta')->name('brteta');
    Route::get('/search', 'HomeController@search')->name('search');
    Route::get('/search/{location}', 'HomeController@location')->name('location');

    Route::get('/book/{id}', 'HomeController@book')->name('book');

    Route::get('/track', 'HomeController@track')->name('track');

    Route::get('/security/password', 'HomeController@password');

    Route::post('/geteta', 'HomeController@geteta')->name('geteta');
    Route::post('/getsearch', 'HomeController@getsearch')->name('getsearch');

    Route::post('/trackbrt', 'HomeController@trackbrt')->name('trackbrt');


    Route::get('/finaleta/{id}/{dest}', 'HomeController@finaleta')->name('brteta');


    Route::post('/security/password/change', 'HomeController@update_password')->name('change_password');




});
