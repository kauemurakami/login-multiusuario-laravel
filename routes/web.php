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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
# dashborad admin
Route::get('/admin', 'AdminController@index')->name('admin.dashboard');

Route::get('/admin/login', 'Auth\AdminLoginController@index')->name('admin.login');
# formulario de login admin
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

