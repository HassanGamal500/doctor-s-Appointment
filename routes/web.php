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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
	

Route::get('/admin/preLogin', 'admin\LoginController@showLoginForm')->name('admin.login');
Route::post('/admin/preLogin', 'admin\LoginController@login')->name('admin.login.post');
Route::get('/admin/preLogout', 'admin\LoginController@logout')->name('admin.logout');
Route::post('/getToken', 'AdminsPush@getToken')->name('getToken');
Route::post('/getTokenWeb', 'AdminsPush@getTokenWeb')->name('getTokenWeb');

Route::group(['prefix' => '/','namespace' => 'website', 'middleware' => 'auth'], function (){
	Route::get('/profile', 'ProfileController@index')->name('profile');
	Route::post('/updateProfile', 'ProfileController@updateProfile')->name('updateProfile');
	Route::get('/order', 'OrderController@index')->name('order');
	Route::post('/makeOrder', 'OrderController@makeOrder')->name('makeOrder');
	Route::get('/appointment', 'AppointmentController@index')->name('appointmentStatus');
	Route::post('/appointmentChangeStatus', 'AppointmentController@changeStatus')->name('changeStatus');
});

Route::group(['prefix' => '/admin','namespace' => 'admin', 'middleware' => ['admin']], function (){
	// Dashboard
	Route::get('/', 'DashboardController@index')->name('dashboard');

	// Patients
    Route::get('/patients', 'PatientController@index')->name('patients');
    Route::get('/add_patient', 'PatientController@create')->name('add_patient');
    Route::post('/add_patient', 'PatientController@store')->name('store_patient');
    Route::get('/edit_patient/{id}', 'PatientController@edit')->name('edit_patient');
    Route::post('/edit_patient/{id}', 'PatientController@update')->name('update_patient');
    Route::delete('/delete_patient/{id}', 'PatientController@destroy')->name('delete_patient');

    // Specializations
    Route::get('/specializations', 'SpecializationController@index')->name('specializations');
    Route::get('/add_specialization', 'SpecializationController@create')->name('add_specialization');
    Route::post('/add_specialization', 'SpecializationController@store')->name('store_specialization');
    Route::get('/edit_specialization/{id}', 'SpecializationController@edit')->name('edit_specialization');
    Route::post('/edit_specialization/{id}', 'SpecializationController@update')->name('update_specialization');
    Route::delete('/delete_specialization/{id}', 'SpecializationController@destroy')->name('delete_specialization');

    // Doctors
	Route::get('/doctors', 'DoctorController@index')->name('doctors');
    Route::get('/add_doctor', 'DoctorController@create')->name('add_doctor');
    Route::post('/add_doctor', 'DoctorController@store')->name('store_doctor');
    Route::get('/edit_doctor/{id}', 'DoctorController@edit')->name('edit_doctor');
    Route::post('/edit_doctor/{id}', 'DoctorController@update')->name('update_doctor');
    Route::delete('/delete_doctor/{id}', 'DoctorController@destroy')->name('delete_doctor');

    // pains
	Route::get('/pains', 'PainController@index')->name('pains');
    Route::get('/add_pain', 'PainController@create')->name('add_pain');
    Route::post('/add_pain', 'PainController@store')->name('store_pain');
    Route::get('/edit_pain/{id}', 'PainController@edit')->name('edit_pain');
    Route::post('/edit_pain/{id}', 'PainController@update')->name('update_pain');
    Route::delete('/delete_pain/{id}', 'PainController@destroy')->name('delete_pain');

    // Orders
	Route::get('/orders', 'OrderController@index')->name('orders');
    Route::get('/add_order', 'OrderController@create')->name('add_order');
    Route::post('/add_order', 'OrderController@store')->name('store_order');
    Route::get('/edit_order/{id}', 'OrderController@edit')->name('edit_order');
    Route::post('/edit_order/{id}', 'OrderController@update')->name('update_order');
    Route::delete('/delete_order/{id}', 'OrderController@destroy')->name('delete_order');
    Route::get('order_notify', 'OrderController@order_notify')->name('order_notify');
    Route::get('get_orders', 'OrderController@getOrders')->name('order_count');

    // Appointments
	Route::get('/appointments', 'AppointmentController@index')->name('appointments');
    Route::get('/add_appointment', 'AppointmentController@create')->name('add_appointment');
    Route::get('/add_appointment/{id}', 'AppointmentController@createOrder')->name('add_appointment_order');
    Route::post('/add_appointment', 'AppointmentController@store')->name('store_appointment');
    Route::get('/edit_appointment/{id}', 'AppointmentController@edit')->name('edit_appointment');
    Route::post('/edit_appointment/{id}', 'AppointmentController@update')->name('update_appointment');
    Route::delete('/delete_appointment/{id}', 'AppointmentController@destroy')->name('delete_appointment');
    Route::get('appointment_notify', 'AppointmentController@appointment_notify')->name('appointment_notify');
    Route::get('get_appointments', 'AppointmentController@getAppointments')->name('appointment_count');

    //Get Notifiactions
    Route::get('get_notifications', 'OrderController@getNotifications')->name('notification_count');

    // Countries
	Route::get('/countries', 'CountryController@index')->name('countries');
    Route::get('/add_country', 'CountryController@create')->name('add_country');
    Route::post('/add_country', 'CountryController@store')->name('store_country');
    Route::get('/edit_country/{id}', 'CountryController@edit')->name('edit_country');
    Route::post('/edit_country/{id}', 'CountryController@update')->name('update_country');
    Route::delete('/delete_country/{id}', 'CountryController@destroy')->name('delete_country');

    // Doctor's Appointments
    Route::get('/doctorAppointments', 'DoctorAppointmentController@index')->name('doctorAppointments');
    Route::post('/doctorAppointmentStatus', 'DoctorAppointmentController@changeStatus')->name('doctorAppointmentStatus');
    
});