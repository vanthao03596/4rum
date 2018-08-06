<?php
Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
Route::get('/', 'AdminController@index')->name('admin.dashboard');
Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::get('/users', 'Admin\UserController@index')->name('admin.users.index');
Route::get('/threads', 'Admin\ThreadController@index')->name('admin.threads.index');



