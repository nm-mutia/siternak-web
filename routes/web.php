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

Route::group(['midlleware' => 'web'], function() {
	//auth
	Auth::routes();

	//index
	Route::get('/', 'HomeController@index')->middleware('auth');
	Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

	//admin
	Route::group(['prefix' => 'admin', 'middleware' => ['role', 'auth']], function(){
		Route::get('/', 'Admin\HomeController@index');
	});

	//peternak
	Route::group(['prefix' => 'peternak', 'middleware' => ['role', 'auth']], function(){
		Route::get('/', 'Peternak\HomeController@index')->name('peternak');
	});

});

