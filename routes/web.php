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
	// Route::get('/', 'HomeController@index')->middleware('auth');
	Route::get('/', function(){
		return view('welcome');
	});

	//admin
	Route::prefix('admin')->middleware('can:isAdmin', 'auth')->group(function(){
		Route::get('/', 'Admin\HomeController@index')->name('admin');
		
		Route::name('admin.')->group(function(){
			Route::get('dashboard', 'Admin\HomeController@index')->name('dashboard');
		});
	});

	//peternak
	Route::prefix('peternak')->middleware('can:isPeternak', 'auth')->group(function(){
		Route::get('/', 'Peternak\HomeController@index')->name('peternak');

		Route::name('peternak.')->group(function(){
			Route::get('dashboard', 'Peternak\HomeController@index')->name('dashboard');
		});
	});

});

