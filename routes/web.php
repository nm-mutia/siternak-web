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
	Route::get('/', 'Auth\LoginController@showLoginForm');

	//admin
	Route::prefix('admin')->middleware('can:isAdmin', 'auth')->group(function(){
		//dashboard
		Route::get('/', 'Admin\HomeController@index')->name('admin');
		
		Route::namespace('admin')->name('admin.')->group(function(){
			Route::get('search', 'HomeController@search')->name('search');

			//data
			Route::resource('ternak', 'TernakController')->except(['create']);
			Route::get('ternaktrash', 'TernakController@trash')->name('ternak.trash');
			Route::get('ternak/restore/{id}', 'TernakController@restore')->name('ternak.restore');
			Route::get('ternakrestore', 'TernakController@restoreAll')->name('ternak.restoreAll');
			Route::get('ternak/fdelete/{id}', 'TernakController@fdelete')->name('ternak.fdelete');
			Route::get('ternakfdelete', 'TernakController@fdeleteAll')->name('ternak.fdeleteAll');
			Route::resource('ras', 'RasController')->except(['create', 'show']);
			Route::resource('penyakit', 'PenyakitController')->except(['create']);
			Route::resource('riwayat', 'RiwayatPenyakitController')->except(['create', 'show']);
			Route::resource('kematian', 'KematianController')->except(['create', 'show']);
			Route::resource('pemilik', 'PemilikController')->except(['create']);
			Route::resource('perkawinan', 'PerkawinanController')->except(['create', 'show']);

			//barcode
			Route::get('barcode', 'BarcodeController@index')->name('barcode');
			Route::get('barcode/pdf', 'BarcodeController@generatePdf')->name('barcode.pdf');

			//perkawinan
			Route::get('match', 'HomeController@p_index')->name('match');
			Route::get('match/ternak', 'HomeController@p_match')->name('match.ternak');

			//grafik
			Route::get('grafik', 'GrafikController@index')->name('grafik');
			Route::get('grafik/lahir', 'GrafikController@grafikLahir')->name('grafik.lahir');

			//laporan
			Route::get('laporan', 'LaporanController@index')->name('laporan');
			Route::get('laporan/lahir', 'LaporanController@lahir')->name('laporan.lahir');
			Route::get('laporan/mati', 'LaporanController@mati')->name('laporan.mati');
			Route::get('laporan/kawin', 'LaporanController@kawin')->name('laporan.kawin');
			Route::get('laporan/sakit', 'LaporanController@sakit')->name('laporan.sakit');
			Route::get('laporan/ada', 'LaporanController@ada')->name('laporan.ada');
			Route::get('laporan/export/{date}', 'LaporanController@export')->name('laporan.export');
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

