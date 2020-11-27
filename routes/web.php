<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes(['register' => false]);



Route::group(['middleware' => 'guest'], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('/');
    Route::any('login', 'Auth\LoginController@login');
});

/***cliente logueados****/

Route::group(['middleware' => 'auth'], function () {

    Route::any('logout', 'Auth\LoginController@logout');
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('homeDashboard', 'HomeController@dashboard')->name('home.dashboard');



});

Route::get('/home', 'HomeController@index')->name('home');

//Route::group(['middleware' => ['CheckRol:Administrador']], function () {
    Route::get('empresa', 'EmpresaController@index')->name('empresa.index');
    Route::get('empresa/create','EmpresaController@create')->name('empresa.create');
    Route::get('empresa/{id}/edit','EmpresaController@edit')->name('empresa.edit');
    Route::post('empresa','EmpresaController@store')->name('empresa.store');
    Route::patch('empresa/{id}/update','EmpresaController@update')->name('empresa.update');
    Route::get('empresa/{id}/delete','EmpresaController@destroy')->name('empresa.destroy');

    Route::get('cliente', 'ClienteController@index')->name('cliente.index');
    Route::get('cliente/create','ClienteController@create')->name('cliente.create');
    Route::get('cliente/{id}/edit','ClienteController@edit')->name('cliente.edit');
    Route::post('cliente','ClienteController@store')->name('cliente.store');
    Route::patch('cliente/{id}/update','ClienteController@update')->name('cliente.update');
    Route::get('cliente/{id}/delete','ClienteController@destroy')->name('cliente.destroy');

//});
