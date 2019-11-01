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

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::get('admin/feed/ajaxDestroyMedia', 'FeedController@ajaxDestroyMedia')->name('admin.feed.ajaxDestroyMedia');
Route::get('admin/feed/getFeedsDatatable', 'FeedController@getFeedsDatatable')->name('admin.feed.getFeedsDatatable');
Route::resource('admin/feed', 'FeedController');
