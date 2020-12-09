<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('/');
    Route::any('login', 'Auth\LoginController@login');
});


Route::group(['middleware' => 'auth'], function () {

    Route::any('logout', 'Auth\LoginController@logout');
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('homeDashboard', 'HomeController@dashboard')->name('home.dashboard');

    //Empresas
    Route::get('empresa', 'EmpresaController@index')->name('empresa.index');
    Route::get('empresa/create','EmpresaController@create')->name('empresa.create');
    Route::get('empresa/{id}/edit','EmpresaController@edit')->name('empresa.edit');
    Route::post('empresa','EmpresaController@store')->name('empresa.store');
    Route::patch('empresa/{id}/update','EmpresaController@update')->name('empresa.update');
    Route::get('empresa/{id}/delete','EmpresaController@destroy')->name('empresa.destroy');

    //Clientes
    Route::get('cliente', 'ClienteController@index')->name('cliente.index');
    Route::get('cliente/create','ClienteController@create')->name('cliente.create');
    Route::get('cliente/{id}/edit','ClienteController@edit')->name('cliente.edit');
    Route::post('cliente','ClienteController@store')->name('cliente.store');
    Route::patch('cliente/{id}/update','ClienteController@update')->name('cliente.update');
    Route::get('cliente/{id}/delete','ClienteController@destroy')->name('cliente.destroy');

    //Alarmas
    Route::get('alarma', 'AlarmaController@index')->name('alarma.index');
    Route::get('alarma/create','AlarmaController@create')->name('alarma.create');
    Route::get('alarma/{id}/edit','AlarmaController@edit')->name('alarma.edit');
    Route::post('alarma','AlarmaController@store')->name('alarma.store');
    Route::patch('alarma/{id}/update','AlarmaController@update')->name('alarma.update');
    Route::get('alarma/{id}/delete','AlarmaController@destroy')->name('alarma.destroy');
    Route::get('notificacion', 'AlarmaController@sendmail')->name('notificacion');


    //Cuentas
    Route::get('cuenta', 'CuentaController@index')->name('cuenta.index');
    Route::get('cuenta/create','CuentaController@create')->name('cuenta.create');
    Route::get('cuenta/{id}/edit','CuentaController@edit')->name('cuenta.edit');
    Route::post('cuenta','CuentaController@store')->name('cuenta.store');
    Route::patch('cuenta/{id}/update','CuentaController@update')->name('cuenta.update');
    Route::get('cuenta/{id}/delete','CuentaController@destroy')->name('cuenta.destroy');



});
