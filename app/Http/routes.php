<?php


//RUTA RAIZ ES EL INDEX DE LAS CITAS
Route::get('/', 'AppointmentsController@index');

/* MODULO APPOINTMENTS*/
Route::resource('/appointments', 'AppointmentsController');

//RUTA PARA REALIZAR EL FILTRADO DE CITAS
Route::post('filtrar', 'AppointmentsController@filtrar');
//RUTA DE LA VISTA QUE SE USARA PARA MOSTRAR LAS CITAS FILTRADAS
Route::post('table', 'AppointmentsController@index2');

/* MODULO PATIENTS*/
Route::resource('/patients', 'PatientsController');

/* MODULO DENTISTS*/
Route::resource('/dentists', 'DentistsController');

/* MODULO SERVICES*/
Route::resource('/services', 'ServicesController');

