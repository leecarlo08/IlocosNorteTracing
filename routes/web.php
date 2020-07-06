<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes();

Route::get('/', function(){
    return redirect('/profile');
});
Route::get('get-cities/{id}', 'HomeController@getCities');
Route::get('get-brgys/{id}', 'HomeController@getBrgys');
Route::get('get-my-qr', 'HomeController@myQR');

Route::get('get-tourist-name', 'HomeController@findTourist');
Route::get('get-accommodation-name', 'HomeController@findAccommodation');

Route::get('get-spots', 'HomeController@getSpots');

Route::prefix('profile')->group(function(){

    Route::post('agree', 'HomeController@agreeHealth');
    Route::get('get-schedules', 'ScheduleController@getSchedules');
    Route::get('schedule-data/{id}', 'ScheduleController@getData');
    Route::post('schedule/create', 'ScheduleController@store');
    Route::post('delete-schedule/{id}', 'ScheduleController@destroy');
    Route::post('schedule/{id}/update', 'ScheduleController@update');

    Route::get('/{vue_route?}', 'HomeController@index')->where('vue_route', '[\/\w\.-]*');
});


include 'spotOfficer.php';
include 'admin.php';
