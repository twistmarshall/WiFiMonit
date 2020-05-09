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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');

Route::get('/user', 'UserController@showProfile')->name('users.showProfile');
Route::put('/user/profile', 'UserController@changeUserProfile')->name('user.view.change.profile');
Route::get('/user/changepassword', 'UserController@changeUserPasswordView')->name('user.view.change.password');
Route::patch('/user/password', 'UserController@changeUserPassword')->name('users.changePassword');
