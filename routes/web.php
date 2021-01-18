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

// ここから追加
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('/login/admin');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->name('admin-register');


Route::view('/admin', 'admin')->middleware('auth:admin')->name('admin-home');
//Route::post('/logout', 'Auth\LoginController@Adminlogout')->middleware('auth:admin')->name('logout');
