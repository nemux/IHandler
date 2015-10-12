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

/**
 * Esto permite pasar Objetos a las rutas, en lugar de IDs
 */
Route::model('user', 'Models\User');

Route::bind('user', function ($value, $route) {
    return App\Models\User::whereUsername($value)->first();
});


Route::get('/', ['as' => 'login.get', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('/', ['as' => 'login.post', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::get('/', ['as' => 'dashboard.index', 'uses' => 'DashboardController@index']);

    Route::group(['prefix' => 'incident'], function () {
        Route::get('/', ['as' => 'incident.index', 'uses' => 'IncidentController@index']);
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', ['as' => 'user.index', 'uses' => 'UserController@index']);
        Route::get('/create', ['as' => 'user.create', 'uses' => 'UserController@create']);
        Route::post('/create', ['as' => 'user.create', 'uses' => 'UserController@store']);
        Route::get('/{user}', ['as' => 'user.show', 'uses' => 'UserController@show']);
        Route::get('/edit/{user}', ['as' => 'user.edit', 'uses' => 'UserController@edit']);
        Route::post('/edit/{user}', ['as' => 'user.update', 'uses' => 'UserController@update']);
        Route::delete('/{user}', ['as' => 'user.destroy', 'uses' => 'UserController@destroy']);

        Route::post('/changepass', ['as' => 'user.change_pass', 'uses' => 'UserController@changePass']);
    });
});
