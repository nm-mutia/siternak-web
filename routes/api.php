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
		Route::post('details', 'UserController@get_user_details_info');
		Route::get('logout', 'UserController@logout');


		Route::apiResource('ras', 'RasController');

		// admin
		Route::prefix('admin')->middleware('can:isAdmin')->group(function(){
		});

	});

});

