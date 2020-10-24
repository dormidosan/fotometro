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
    return view('welcome');
});

Route::get('/prueba', function () {
    echo "PRUEBA FUNCIONAL";
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/mediciones', 'MedicionController@index')->name('mediciones.index');
Route::get('/mediciones/realtime', 'MedicionController@showRealTime')->name('mediciones.showRealTime');
Route::post('/mediciones/daily', 'MedicionController@showDaily')->name('mediciones.showDaily');
Route::post('/mediciones/monthly', 'MedicionController@showMonthly')->name('mediciones.showMonthly');
Route::get('/mediciones/meses', 'MedicionController@showMeses')->name('mediciones.showMeses');

