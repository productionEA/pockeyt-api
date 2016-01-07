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
Route::post('profiles/{profile}/photos', 'ProfilesController@postPhotos');
Route::post('profiles/{profile}/approve', 'ProfilesController@postApprove');
Route::post('profiles/{profile}/unapprove', 'ProfilesController@postUnapprove');
Route::delete('profiles/{profile}/photos', 'ProfilesController@deletePhotos');
Route::resource('profiles', 'ProfilesController');

// API Routes
Route::controller('api', 'APIController');