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




Route::get('ajaxRequest', 'AppointmentsController@ajaxRequest');
//Route::post('ajaxRequest', 'AppointmentsController@ajaxRequestPost');

Route::post('index2', 'AppointmentsController@index2');
Route::post('apponuntments/index2', 'AppointmentsController@index2');

Route::post('filtro', 'AppointmentsFiltroController@index');

//Route::resource('/appointmentsFiltro', 'AppointmentsFiltroController');


/* MODULO PATIENTS*/
Route::resource('/patients', 'PatientsController');

/* MODULO DENTISTS*/
Route::resource('/dentists', 'DentistsController');

/* MODULO SERVICES*/
Route::resource('/services', 'ServicesController');

