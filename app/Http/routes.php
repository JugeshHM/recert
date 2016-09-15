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
    return view('index');
})->name('home');

Route::get('/unsupported-browser', function() {
    return view('unsupported');
})->name('unsupported');

$api = app('api.router');
//$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Http\Controllers'], function ($api) {
    // Non-Authenticated Routes
    $api->post('/login', 'TokenAuthController@postLogin');
    $api->post('/register', 'TokenAuthController@postRegister');

    // Authenticated Routes
    $api->group(['middleware' => 'api.auth', 'protected' => true], function ($api) {
        $api->get('/logout', 'Auth\AuthController@getLogout');
        $api->get('/profile', 'TokenAuthController@getProfile');

        $api->get('/role/{id?}', 'RoleController@getRole');
        $api->get('/state/{id?}', 'StateController@getState');
        $api->get('/category/{id?}', 'CategoryController@getCategory');
        $api->get('/permission/{id?}', 'PermissionController@getPermission');

        $api->get('/user/{id?}', ['middleware' => ['ability:admin,get-user'], 'uses' => 'UserController@getUser']);
        $api->put('/user/{id}', ['middleware' => ['ability:admin,update-user'], 'uses' => 'UserController@updateUser']);
        $api->delete('/user/{id}', ['middleware' => ['ability:admin,delete-user'], 'uses' => 'UserController@deleteUser']);

        $api->post('/role', ['middleware' => ['ability:admin,create-role'], 'uses'=> 'RoleController@postRole']);
        $api->put('/role/{id}', ['middleware' => ['ability:admin,update-role'], 'uses' => 'RoleController@updateRole']);
        $api->delete('/role/{id}', ['middleware' => ['ability:admin,delete-role'], 'uses' => 'RoleController@deleteRole']);

        $api->post('/state', ['middleware' => ['ability:admin,create-state'], 'uses' => 'StateController@postState']);
        $api->put('/state/{id}', ['middleware' => ['ability:admin,update-state'], 'uses' => 'StateController@updateState']);
        $api->delete('/state/{id}', ['middleware' => ['ability:admin,delete-state'], 'uses' => 'StateController@deleteState']);

        $api->post('/category', ['middleware' => ['ability:admin,create-category'], 'uses' => 'CategoryController@postCategory']);
        $api->put('/category/{id}', ['middleware' => ['ability:admin,update-category'], 'uses' => 'CategoryController@updateCategory']);
        $api->delete('/category/{id}', ['middleware' => ['ability:admin,delete-category'], 'uses' => 'CategoryController@deleteCategory']);

        $api->post('/permission', ['middleware' => ['ability:admin,create-permission'], 'uses'=> 'PermissionController@postPermission']);
        $api->put('/permission/{id}', ['middleware' => ['ability:admin,update-permission'], 'uses' => 'PermissionController@updatePermission']);
        $api->delete('/permission/{id}', ['middleware' => ['ability:admin,delete-role'], 'uses' => 'PermissionController@deletePermission']);

    });
});