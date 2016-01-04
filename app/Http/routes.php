<?php

Route::get('/', 'PagesController@home');
Route::get('my_posts', 'PagesController@my_posts');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//Photos routes
Route::post('{business_name}/photos', 'ProfilesController@addPhoto');
Route::delete('photos/{id}', 'ProfilesController@destroyPhoto');

//Posts routes
Route::get('posts', 'PostsController@index');
Route::post('posts', 'PostsController@store');
Route::get('posts/{id}', 'PostsController@show');

//Profile routes
Route::resource('profiles', 'ProfilesController');
Route::get('photos', 'ProfilesController@index');
Route::get('{business_name}', 'ProfilesController@show');

