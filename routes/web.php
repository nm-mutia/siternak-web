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
    return view('home');
});
Route::get('/home', function () {
    return view('admin.dashboard');
});
Route::get('/ternak', function () {
    return view('data.data');
});
Route::get('/perkawinan', function () {
    return view('perkawinan.kawin');
});
Route::get('/grafik', function () {
    return view('grafik.grafik');
});
Route::get('/laporan', function () {
    return view('admin.laporan');
});
