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

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    Route::get('/', 'Admin\AdminController@index')->name('admin');
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
    Route::get('logout-admin', 'Admin\AdminController@logoutAdmin')->name('logout-admin');
    Route::get('member', 'Admin\AdminController@showMember')->name('member.show');
    Route::get('supervisor', 'Admin\AdminController@showSupervisor')->name('supervisor.show');
    Route::resource('course', 'Admin\CourseController');
    Route::resource('subject', 'Admin\SubjectController');
    Route::get('show-trainee', 'Admin\AddTraineeToCourseController@index')->name('show-trainee');
    Route::post('post-trainee', 'Admin\AddTraineeToCourseController@show');
    Route::get('add-trainee', 'Admin\AddTraineeToCourseController@create')->name('trainee.create');
    Route::post('show-subject', 'Admin\AddTraineeToCourseController@showSubject');
    Route::post('add-trainee', 'Admin\AddTraineeToCourseController@stores')->name('trainee.stores');
    Route::get('delete-trainee/{user}/{course}', 'Admin\AddTraineeToCourseController@deleteTrainee')->name('trainee.destroy');
    Route::get('show-suppervisor', 'Admin\AddSuppervisorController@index')->name('suppervisor.index');
    Route::post('show-suppervisor', 'Admin\AddSuppervisorController@show');
    Route::get('delete-suppervisor/{user}/{course}', 'Admin\AddSuppervisorController@delete')->name('suppervisor.destroy');
    Route::get('add-suppervisor', 'Admin\AddSuppervisorController@create')->name('supperviosr.create');
    Route::post('add-suppervisor', 'Admin\AddSuppervisorController@stores')->name('suppervisor.stores');
});

Route::get('course-study', 'CourseStudyController@index')->name('coures_study');
Route::get('course-subject/{id}', 'CourseStudyController@ShowSubject')->name('course_subject');
Route::get('subject-detail/{id}', 'CourseStudyController@SubjectDetails')->name('subject.details');
Route::get('show-course/{id}', 'HomeController@show')->name('course.show');
Route::get('profile/{id}', 'UserController@show')->name('profile.show');
Route::get('my-profile/{id}', 'UserController@index')->name('myprofile.show');
Route::patch('update-profile/{id}', 'UserController@update')->name('profile.update');
Route::get('show-report', 'CourseStudyController@showReport')->name('show-report');
Route::post('report', 'CourseStudyController@report')->name('report');
