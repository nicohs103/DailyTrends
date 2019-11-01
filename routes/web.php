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


Route::resource('/', 'WelcomeController');


Route::get('/home', function() {
    return redirect('admin/feed');
})->name('home')->middleware('auth');

Route::get('admin/feed/ajaxDestroyMedia', 'FeedController@ajaxDestroyMedia')->name('admin.feed.ajaxDestroyMedia');
Route::get('admin/feed/getFeedsDatatable', 'FeedController@getFeedsDatatable')->name('admin.feed.getFeedsDatatable');
Route::resource('admin/feed', 'FeedController');


Route::get('admin/users/getUsersDatatable', 'UserController@getUsersDatatable')->name('admin.users.getUsersDatatable');
Route::post('admin/users/store', 'UserController@store')->name('admin.users.store');
Route::post('admin/users/store-password', 'UserController@storePassword')->name('admin.users.store-password');
Route::get('admin/users/destroy/{id}', 'UserController@destroy')->name('admin.users.destroy');
Route::resource('admin/users', 'UserController');

// Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
