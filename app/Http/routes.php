<?php

Route::get('/', 'AppController@index');

// Auth routes...
Route::get('auth/login',        'Auth\AuthController@getLogin');
Route::post('auth/login',       'Auth\AuthController@postLogin');
Route::get('auth/logout',       'Auth\AuthController@getLogout');
Route::get('auth/register',     'Auth\AuthController@getRegister');
Route::post('auth/register',    'Auth\AuthController@postRegister');

// Posts routes...
Route::resource('posts', 'PostsController', ['only' => ['index', 'store', 'show']]);

// Profile routes...
Route::get('profiles/{id}/posts', 'ProfilesController@getPosts');
Route::resource('profiles', 'ProfilesController', ['except' => ['index']]);

// Photo routes...
Route::resource('photos', 'PhotosController', ['only' => ['store', 'destroy']]);