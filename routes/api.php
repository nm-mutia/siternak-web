<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->namespace('API')->group(function(){
	Route::post('login', 'UserController@login');
	Route::post('register', 'UserController@register');

	Route::middleware('auth:api')->group(function(){
		Route::get('profile', 'UserController@get_user_details_info');
		Route::get('logout', 'UserController@logout');

		Route::apiResource('ras', 'RasController');
		Route::apiResource('pemilik', 'PemilikController');
		Route::apiResource('penyakit', 'PenyakitController');
		Route::apiResource('kematian', 'KematianController');
		Route::apiResource('ternak', 'TernakController');
		Route::apiResource('peternak', 'PeternakController');
		Route::apiResource('peternakan', 'PeternakanController');
		Route::apiResource('perkawinan', 'PerkawinanController');
		Route::apiResource('riwayat', 'RiwayatPenyakitController');

		Route::get('ternaktrash', 'TernakController@trash');
		Route::get('ternaktrash/{id}', 'TernakController@trashid');
		Route::get('ternaktrash/restore/{id}', 'TernakController@restore');
		Route::get('ternaktrash/restore', 'TernakController@restoreAll');
		Route::delete('ternaktrash/fdelete/{id}', 'TernakController@fdelete');
		Route::delete('ternaktrash/fdelete', 'TernakController@fdeleteAll');

		Route::get('scan/{id}', 'ScanController@search');
		Route::get('match', 'MatchController@match');

		Route::get('grafik', 'GrafikController@index');
		Route::get('grafik/lahir', 'GrafikController@grafikLahir');
		Route::get('grafik/mati', 'GrafikController@grafikMati');

		Route::get('barcode', 'BarcodeController@index');

		Route::get('laporan', 'LaporanController@index');

		//for select option
		Route::get('options', 'OptionsController@index');

	});

});

