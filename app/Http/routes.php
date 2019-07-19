<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});



/* MODULO APPOINTMENTS*/
Route::resource('/appointments', 'AppointmentsController');
//Route::get('appointments/index2/{fecha_inicio}/{fecha_fin}','AppointmentsController@index2');




Route::get('/appointments/index2/{fecha_inicio}/{fecha_fin}', [
  'uses' => 'AppointmentsController@index2',
  'as' => 'appointments.index2'
]);


Route::post('/appointments/index2/{fecha_inicio}/{fecha_fin}' , [
  'uses' => 'AppointmentController@index2',
  'as' => 'appointments.index2'
]);



/* MODULO PATIENTS*/
Route::resource('/patients', 'PatientsController');

/* MODULO DENTISTS*/
Route::resource('/dentists', 'DentistsController');

/* MODULO SERVICES*/
Route::resource('/services', 'ServicesController');

