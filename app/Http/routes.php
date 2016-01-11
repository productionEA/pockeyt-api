<?php

Route::get('/', 'AppController@index')->name('app.index');

// Auth routes...
Route::get('auth/login',        'Auth\AuthController@getLogin')->name('auth.login');
Route::post('auth/login',       'Auth\AuthController@postLogin');
Route::get('auth/logout',       'Auth\AuthController@getLogout')->name('auth.logout');
Route::get('auth/register',     'Auth\AuthController@getRegister')->name('auth.register');
Route::post('auth/register',    'Auth\AuthController@postRegister');

// Posts routes...
Route::resource('posts', 'PostsController', ['only' => ['index', 'store', 'show', 'destroy']]);

// Profile routes...
Route::post('profiles/{profiles}/photos', 'ProfilesController@postPhotos')->name('profiles.photos');
Route::delete('profiles/{profiles}/photos', 'ProfilesController@deletePhotos');
Route::post('profiles/{profiles}/approve', 'ProfilesController@postApprove')->name('profiles.approve');
Route::post('profiles/{profiles}/unapprove', 'ProfilesController@postUnapprove')->name('profiles.unapprove');
Route::resource('profiles', 'ProfilesController');

// API Routes
Route::controller('api', 'APIController', [
    'getPosts' => 'api.posts',
    'getPost' => 'api.post',
    'getProfiles' => 'api.profiles',
    'getProfile' => 'api.profile',
]);