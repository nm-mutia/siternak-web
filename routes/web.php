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

// Route::group(['midlleware' => 'web'], function() {
	//auth
	Auth::routes();
	// Auth::routes(['verify' => true]);

	//index
	Route::get('/', 'Auth\LoginController@showLoginForm');
	Route::get('/home', 'HomeController@index')->middleware('auth')->name('home');
	// Route::get('/home', 'HomeController@index')->middleware('auth', 'verified')->name('home');

	//--------------------- admin --------------------------------------
	// Route::prefix('admin')->middleware('can:isAdmin', 'auth', 'verified')->group(function(){
	Route::prefix('admin')->middleware('can:isAdmin', 'auth')->group(function(){
		//dashboard
		Route::get('/', 'Admin\HomeController@index')->name('admin');

		
		Route::namespace('Admin')->name('admin.')->group(function(){
			// search
			Route::get('search', 'HomeController@search')->name('search');

			// profil
			Route::get('profile', 'ProfileController@index')->name('profile');
			Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');
			Route::put('profile/edit', 'ProfileController@update')->name('profile.update');
			Route::post('password/change', 'ProfileController@postChangePassword')->name('password.update');

			//data
			Route::resource('ternak', 'TernakController')->except(['create']);
			Route::get('ternaktrash', 'TernakController@trash')->name('ternak.trash');
			Route::get('ternak/restore/{id}', 'TernakController@restore')->name('ternak.restore');
			Route::get('ternakrestore', 'TernakController@restoreAll')->name('ternak.restoreAll');
			Route::delete('ternak/fdelete/{id}', 'TernakController@fdelete')->name('ternak.fdelete');
			Route::delete('ternakfdelete', 'TernakController@fdeleteAll')->name('ternak.fdeleteAll');
			Route::resource('ras', 'RasController')->except(['create', 'show']);
			Route::resource('penyakit', 'PenyakitController')->except(['create']);
			Route::resource('riwayat', 'RiwayatPenyakitController')->except(['create', 'show']);
			Route::resource('kematian', 'KematianController')->except(['create', 'show']);
			Route::resource('pemilik', 'PemilikController')->except(['create']);
			Route::resource('peternakan', 'PeternakanController')->except(['create']);
			Route::resource('perkawinan', 'PerkawinanController')->except(['create', 'show']);
			Route::get('perkawinan/pasangan/{id}', 'PerkawinanController@getPasangan');

			// data peternak
			Route::resource('peternak', 'PeternakController')->except(['create']);

			//barcode
			Route::get('barcode', 'BarcodeController@index')->name('barcode');
			Route::get('barcode/pdf', 'BarcodeController@generatePdf')->name('barcode.pdf');

			//perkawinan
			Route::get('match', 'MatchController@index')->name('match');
			Route::get('match/ternak', 'MatchController@match')->name('match.ternak');

			//grafik
			Route::get('grafik', 'GrafikController@index')->name('grafik');
			Route::get('grafik/lahir', 'GrafikController@grafikLahir')->name('grafik.lahir');
			Route::get('grafik/mati', 'GrafikController@grafikMati')->name('grafik.mati');

			//laporan
			Route::get('laporan', 'LaporanController@index')->name('laporan');
			Route::post('laporan/lahir', 'LaporanController@lahir')->middleware('cors')->name('laporan.lahir');
			Route::post('laporan/mati', 'LaporanController@mati')->middleware('cors')->name('laporan.mati');
			Route::post('laporan/kawin', 'LaporanController@kawin')->middleware('cors')->name('laporan.kawin');
			Route::post('laporan/sakit', 'LaporanController@sakit')->middleware('cors')->name('laporan.sakit');
			Route::post('laporan/ada', 'LaporanController@ada')->middleware('cors')->name('laporan.ada');
			Route::get('laporan/export/{date}', 'LaporanController@export')->name('laporan.export');
		});
	});


	//---------------------------------peternak--------------------------------------------
	// Route::prefix('peternak')->middleware('can:isPeternak', 'auth', 'verified')->group(function(){
	Route::prefix('peternak')->middleware('can:isPeternak', 'auth')->group(function(){
		Route::get('/', 'Peternak\HomeController@index')->name('peternak');

		Route::namespace('Peternak')->name('peternak.')->group(function(){
			Route::get('dashboard', 'HomeController@index')->name('dashboard');
			// search
			Route::get('search', 'HomeController@search')->name('search');

			// profil
			Route::get('profile', 'ProfileController@index')->name('profile');
			Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');
			Route::put('profile/edit', 'ProfileController@update')->name('profile.update');
			Route::post('password/change', 'ProfileController@postChangePassword')->name('password.update');

			//data
			Route::resource('ternak', 'TernakController')->except(['create']);
			Route::get('ternaktrash', 'TernakController@trash')->name('ternak.trash');
			Route::get('ternak/restore/{id}', 'TernakController@restore')->name('ternak.restore');
			Route::get('ternakrestore', 'TernakController@restoreAll')->name('ternak.restoreAll');
			Route::delete('ternak/fdelete/{id}', 'TernakController@fdelete')->name('ternak.fdelete');
			Route::delete('ternakfdelete', 'TernakController@fdeleteAll')->name('ternak.fdeleteAll');
			Route::resource('ras', 'RasController')->except(['create', 'show']);
			Route::resource('penyakit', 'PenyakitController')->except(['create']);
			Route::resource('riwayat', 'RiwayatPenyakitController')->except(['create', 'show']);
			Route::resource('kematian', 'KematianController')->except(['create', 'show']);
			Route::resource('pemilik', 'PemilikController')->except(['create']);
			Route::resource('perkawinan', 'PerkawinanController')->except(['create', 'show']);
			Route::get('perkawinan/pasangan/{id}', 'PerkawinanController@getPasangan');

			//barcode
			Route::get('barcode', 'BarcodeController@index')->name('barcode');
			Route::get('barcode/pdf', 'BarcodeController@generatePdf')->name('barcode.pdf');

			//perkawinan
			Route::get('match', 'MatchController@index')->name('match');
			Route::get('match/ternak', 'MatchController@match')->name('match.ternak');

			//grafik
			Route::get('grafik', 'GrafikController@index')->name('grafik');
			Route::get('grafik/lahir', 'GrafikController@grafikLahir')->name('grafik.lahir');
			Route::get('grafik/mati', 'GrafikController@grafikMati')->name('grafik.mati');

			//laporan
			Route::get('laporan', 'LaporanController@index')->name('laporan');
			Route::post('laporan/lahir', 'LaporanController@lahir')->middleware('cors')->name('laporan.lahir');
			Route::post('laporan/mati', 'LaporanController@mati')->middleware('cors')->name('laporan.mati');
			Route::post('laporan/kawin', 'LaporanController@kawin')->middleware('cors')->name('laporan.kawin');
			Route::post('laporan/sakit', 'LaporanController@sakit')->middleware('cors')->name('laporan.sakit');
			Route::post('laporan/ada', 'LaporanController@ada')->middleware('cors')->name('laporan.ada');
			Route::get('laporan/export/{date}', 'LaporanController@export')->name('laporan.export');
		});
	});

// });

