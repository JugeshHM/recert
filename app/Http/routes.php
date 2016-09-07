<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::group(array('prefix' => 'api/v1'), function() {
    // User Routes
    Route::post('/login', 'TokenAuthController@postLogin');
    Route::post('/register', 'TokenAuthController@postRegister');

    Route::get('/logout', 'Auth\AuthController@getLogout');
    Route::get('/profile', 'TokenAuthController@getProfile');

    Route::get('/user/{id?}', 'UserController@getUser');
    Route::put('/user/{id}', 'UserController@updateUser');
    Route::delete('/user/{id}', 'UserController@deleteUser');
});
