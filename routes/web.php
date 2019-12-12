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

Auth::routes();

Route::get('/', function () {
    return view('layouts.schedules');
})->name('/');

Route::middleware(['auth'])->group(function () {
    Route::get('/reservation/all', 'ReservationController@all')->name('reservation.all');
    Route::post('/reservation/{id}/cancel', 'ReservationController@cancel')->name('reservation.cancel');
    Route::post('/reservation/place', 'ReservationController@place')->name('reservation.place');
    Route::get('/reservation/reserve/{tripId}', 'ReservationController@reserve')->name('reservation.reserve');
    Route::get('/schedule/view/{id}', 'ScheduleController@view')->name('schedule.view');
});

Route::middleware(['auth', 'verify.admin'])->group(function () {
    Route::get('/schedule/create', 'ScheduleController@create')->name('schedule.create');
    Route::post('/schedule/delete/{id}', 'ScheduleController@delete')->name('schedule.delete');
    Route::post('/schedule/save', 'ScheduleController@save')->name('schedule.save');
    Route::get('/schedule/edit/{id}', 'ScheduleController@edit')->name('schedule.edit');
});

Route::middleware(['auth', 'verify.manager'])->group(function () {
    Route::get('/schedule/{id}/report', 'ScheduleController@report')->name('schedule.report');
});