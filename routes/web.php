<?php



Route::get('/', function () {
    return redirect('/login'); //view('welcome');
});
 
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//
Route::middleware(['auth','admin'])->namespace('Admin')->group(function(){
	//specialities
Route::get('/specialities', 'SpecialtyController@index');
Route::get('/specialities/create', 'SpecialtyController@create');// formulario de registro 
Route::get('/specialities/{specialty}/edit', 'SpecialtyController@edit');

Route::post('/specialities', 'SpecialtyController@store'); // envio del formulario de registro 
Route::put('/specialities/{specialty}', 'SpecialtyController@update'); // actualizar 
Route::delete('/specialities/{specialty}', 'SpecialtyController@destroy'); //eliminar
// Medico
Route::resource('doctors', 'DoctorController');
// Paciente
Route::resource('patients', 'PatientController');
//charts 
Route::get('/charts/appointments/line','ChartController@appointments');
Route::get('/charts/doctors/column', 'ChartController@doctors');
	Route::get('/charts/doctors/column/data', 'ChartController@doctorsJson');
});

Route::middleware(['auth','doctor'])->namespace('Doctor')->group(function(){
	//specialities

Route::get('/schedule', 'ScheduleController@edit');
Route::post('/schedule', 'ScheduleController@store'); // donde se pueda guardar o actualizar la informacion 

});

Route::middleware('auth')->group(function (){
Route::get('/appointments/create', 'AppointmentController@create');
Route::post('/appointments', 'AppointmentController@store');



Route::get('/appointments', 'AppointmentController@index');

Route::get('/appointments/{appointment}', 'AppointmentController@show');
Route::get('/appointments/{appointment}/cancel', 'AppointmentController@showcancelform');
Route::post('/appointments/{appointment}/cancel', 'AppointmentController@postcancel');
Route::post('/appointments/{appointment}/confirm', 'AppointmentController@postconfirm');

//apointment / id appointment / y cancelar


});

//json

Route::get('/specialties/{specialty}/doctors', 'Api\SpecialtyController@doctors');
Route::get('/schedule/hours', 'Api\ScheduleController@hours');



