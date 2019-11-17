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

Route::resource('Company', 'CompanyController');
Auth::routes();
Route::get('/home', 'CompanyController@index')->name('home');
Route::get('/home/create/company', 'CompanyController@create')->name('createcompany');
Route::post('/home/create/com', 'CompanyController@store')->name('ingresarcomp');
Route::post('/home/update/com/{id}', 'CompanyController@update')->name('actualizarcomp');
Route::get('/home/show/employee/{id}', 'EmployeeController@index')->name('verempleados');
Route::get('/home/create/employe/{id}', 'EmployeeController@create')->name('crearempleado');
Route::post('/home/store/employe', 'EmployeeController@store')->name('almacenaremp');
Route::get('/home/edit/employe/{id}/{es}', 'EmployeeController@edit')->name('editemplo');
Route::delete('/home/del/employe/{id}/{es}', 'EmployeeController@destroy')->name('del');
Route::post('/home/update/employ/{id}/{idcomp}', 'EmployeeController@update')->name('actualizaremp');