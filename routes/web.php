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

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login/admin', 'Auth\LoginController@showUserLoginForm')->name('login.admin');
Route::get('/login/member', 'Auth\LoginController@showMemberLoginForm')->name('login.member');
Route::get('/register/admin', 'Auth\RegisterController@showUserRegisterForm')->name('register.admin');
Route::get('/register/member', 'Auth\RegisterController@showMemberRegisterForm')->name('register.member');

Route::post('/login/admin', 'Auth\LoginController@userLogin');
Route::post('/login/member', 'Auth\LoginController@memberLogin');
Route::post('/register/admin', 'Auth\RegisterController@createUser')->name('register.admin');
Route::post('/register/member', 'Auth\RegisterController@createMember')->name('register.member');

Route::view('/home', 'home')->middleware('auth');

Route::group(['middleware' => 'auth:user'], function () {
    Route::view('/admin', 'back-office/home');
    // Route::view('/admin/users', 'back-office/users');
    Route::resource('admin/users', 'UserController', ['except' => ['edit']]);
    // Route::view('/admin/users/new', 'back-office/templates/users/add');
});

Route::group(['middleware' => 'auth:member'], function () {
    Route::view('/member', 'member-office/home');
});
