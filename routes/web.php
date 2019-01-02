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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['prefix' => 'admin'], function(){
    Route::get('/', 'Admin\AdminController@index')->name('admin');
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
    Route::get('logout-admin', 'Admin\AdminController@logoutAdmin')->name('logout-admin');
    Route::get('member', 'Admin\AdminController@showMember')->name('member.show');
    Route::get('supervisor', 'Admin\AdminController@showSupervisor')->name('supervisor.show');
});
