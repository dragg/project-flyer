<?php

Route::get('/', 'PagesController@home');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', ['as' => 'sign_up.page', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', ['as' => 'sign_up.method', 'uses' => 'Auth\AuthController@postRegister']);


Route::resource('flyers', 'FlyersController');
Route::get('{zip}/{street}', ['as' => 'flyers.show', 'uses' => 'FlyersController@show']);
Route::post('{zip}/{street}/photos', ['as' => 'store_photo_path', 'uses' => 'FlyerPhotosController@store']);
