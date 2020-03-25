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
	// Route::get('/', 'Auth\LoginController@Login');
	Route::get('/', function(){
		return view('welcome');
	});

	//admin
	Route::prefix('admin')->middleware('can:isAdmin', 'auth')->group(function(){
		//dashboard
		Route::get('/', 'Admin\HomeController@index')->name('admin');
		
		Route::namespace('admin')->name('admin.')->group(function(){
			//data
			Route::resource('ternak', 'TernakController');
			Route::resource('ras', 'RasController');
			Route::resource('penyakit', 'PenyakitController');
			Route::resource('riwayat', 'RiwayatPenyakitController');
			Route::resource('kematian', 'KematianController');
			Route::resource('pemilik', 'PemilikController');
			Route::resource('perkawinan', 'PerkawinanController');

			//perkawinan
			Route::get('match', 'HomeController@index')->name('match');

			//grafik
			Route::get('grafik', 'HomeController@index')->name('grafik');

			//laporan
			Route::get('laporan', 'HomeController@index')->name('laporan');
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

