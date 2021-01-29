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

//パスワードリセット
Route::get('password/admin/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('password/admin/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('password/admin/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('password/admin/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');

//マンガトーカー
Route::get('/manga/top', 'Manga\MangaController@top');

Route::get('/manga/create', 'Manga\CategoryController@index')->middleware('auth:admin');
Route::resource('category', 'Manga\CategoryController');

Route::get('/manga/post', 'Manga\PostController@index');
Route::resource('post', 'Manga\PostController');

Route::get('/manga/index', 'Manga\ContentController@index')->name('/manga/index');
Route::resource('content', 'Manga\ContentController');

Route::resource('content_detail', 'Manga\ContentDetailController');

Route::get('/manga/my_contents', 'Manga\MyContentController@index');
Route::resource('my_contents', 'Manga\MyContentController');

Route::get('/manga/admin_contents', 'Manga\AdminContentsController@index')->middleware('auth:admin');
Route::resource('admin_contents', 'Manga\AdminContentsController');

Route::resource('comment', 'Manga\CommentController');
