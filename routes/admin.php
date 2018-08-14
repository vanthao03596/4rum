<?php
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect']
    ],
    function()
    {
        Route::group(['prefix' => 'admin'], function(){

            Route::get('/', 'AdminController@index')->name('admin.dashboard');
            Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
            Route::get('/users', 'Admin\UserController@index')->name('admin.users.index');
            Route::get('/threads', 'Admin\ThreadController@index')->name('admin.threads.index');
            Route::post('/threads/{id}', 'Admin\ThreadController@lock')->name('admin.threads.lock');
            Route::get('/contacts', 'Admin\ContactController@index')->name('admin.contacts');

            Route::get('/replies', 'Admin\ReplyController@index')->name('admin.replies');
            Route::delete('/replies/{id}', 'Admin\ReplyController@destroy')->name('admin.replies.delete');
        });

    });
            Route::post('admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
            Route::post('admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');



