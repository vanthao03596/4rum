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
// Thread
Route::get('/', 'ThreadController@index')->name('threads.index');
Route::get('/threads/{channel}/{thread}', 'ThreadController@show')->name('threads.show');
Route::get('/threads/create', 'ThreadController@create')->name('threads.create');
Route::post('/threads', 'ThreadController@store')->name('threads.store');
Route::delete('/threads/{channel}/{thread}', 'ThreadController@destroy')->name('threads.delete');
Route::get('/threads', 'ThreadController@getData');
// Reply

Route::post('/threads/{channel}/{thread}/replies', 'ReplyController@store');

// Channel
Route::get('/threads/{channel}', 'ChannelController@index')->name('channels.index');

// Favorite
Route::post('/replies/{reply}/favorite', 'FavoriteController@store')->name('like');

// Profile

Route::get('/profile/{user}', 'ProfileController@show')->name('profile.show');
Route::get('/profile/{user}/questions', 'ProfileController@show')->name('profile.questions');
Route::get('/profile/{user}/answers', 'ProfileController@show')->name('profile.answers');
Route::get('/profile/{user}/favorite-questions', 'ProfileController@show')->name('profile.fav_question');
Route::get('/profile/{user}/points', 'ProfileController@show')->name('profile.points');
// Auth
Auth::routes();

Route::get('/test', 'HomeController@index')->name('home');
Route::post('/test', 'HomeController@post')->name('test');