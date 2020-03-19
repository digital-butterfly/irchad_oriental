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

Route::get('/login/admin', 'Auth\LoginController@showUserLoginForm');
Route::get('/login/member', 'Auth\LoginController@showMemberLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showUserRegisterForm');
Route::get('/register/member', 'Auth\RegisterController@showMemberRegisterForm');

Route::post('/login/admin', 'Auth\LoginController@userLogin');
Route::post('/login/member', 'Auth\LoginController@memberLogin');
// Route::post('/register/admin', 'Auth\RegisterController@createUser');
Route::post('/register/member', 'Auth\RegisterController@createMember');

Route::view('/home', 'home')->middleware('auth');
Route::view('/admin', 'user');
Route::view('/member', 'member-office/home');
