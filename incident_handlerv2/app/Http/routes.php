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

    Route::group(['prefix' => 'customer'], function () {
        Route::get('/', ['as' => 'customer.index', 'uses' => 'CustomerController@index']);
        Route::get('/create', ['as' => 'customer.create', 'uses' => 'CustomerController@create']);
        Route::post('/create', ['as' => 'customer.create', 'uses' => 'CustomerController@store']);
        Route::delete('/{id}', ['as' => 'customer.destroy', 'uses' => 'CustomerController@destroy']);
        Route::get('/{id}', ['as' => 'customer.show', 'uses' => 'CustomerController@show']);
        Route::get('/edit/{id}', ['as' => 'customer.edit', 'uses' => 'CustomerController@edit']);
        Route::post('/edit/{id}', ['as' => 'customer.update', 'uses' => 'CustomerController@update']);

        Route::group(['prefix' => 'asset'], function () {
            Route::post('/create', ['as' => 'asset.store', 'uses' => 'CustomerAssetController@store']);
            Route::get('/{id}', ['as' => 'asset.show', 'uses' => 'CustomerAssetController@show']);
            Route::get('/edit/{id}', ['as' => 'asset.edit', 'uses' => 'CustomerAssetController@edit']);
            Route::post('/edit/{id}', ['as' => 'asset.update', 'uses' => 'CustomerAssetController@update']);
            Route::delete('/{id}', ['as' => 'asset.destroy', 'uses' => 'CustomerAssetController@destroy']);
        });

        Route::group(['prefix' => 'employee'], function () {
            Route::get('/create/{customer_id}', ['as' => 'employee.create', 'uses' => 'CustomerEmployeeController@create']);
            Route::post('/create/{customer_id}', ['as' => 'employee.store', 'uses' => 'CustomerEmployeeController@store']);
            Route::get('/{id}', ['as' => 'employee.show', 'uses' => 'CustomerEmployeeController@show']);
            Route::get('/edit/{id}', ['as' => 'employee.edit', 'uses' => 'CustomerEmployeeController@edit']);
            Route::post('/edit/{id}', ['as' => 'employee.update', 'uses' => 'CustomerEmployeeController@update']);
            Route::delete('/{id}', ['as' => 'employee.destroy', 'uses' => 'CustomerEmployeeController@destroy']);
        });

        Route::group(['prefix' => 'page'], function () {
            Route::post('/create', ['as' => 'customer.page.store', 'uses' => 'CustomerPageController@store']);
            Route::get('/{id}', ['as' => 'customer.page.show', 'uses' => 'CustomerPageController@show']);
            Route::get('/edit/{id}', ['as' => 'customer.page.edit', 'uses' => 'CustomerPageController@edit']);
            Route::post('/edit/{id}', ['as' => 'customer.page.update', 'uses' => 'CustomerPageController@update']);
            Route::delete('/{id}', ['as' => 'customer.page.destroy', 'uses' => 'CustomerPageController@destroy']);
        });

        Route::group(['prefix' => 'sensor'], function () {
            Route::post('/create', ['as' => 'sensor.store', 'uses' => 'CustomerSensorController@store']);
            Route::get('/{id}', ['as' => 'sensor.show', 'uses' => 'CustomerSensorController@show']);
            Route::get('/edit/{id}', ['as' => 'sensor.edit', 'uses' => 'CustomerSensorController@edit']);
            Route::post('/edit/{id}', ['as' => 'sensor.update', 'uses' => 'CustomerSensorController@update']);
            Route::delete('/{id}', ['as' => 'sensor.destroy', 'uses' => 'CustomerSensorController@destroy']);
        });
    });

    Route::group(['prefix' => 'surveillance'], function () {
        Route::get('/', ['as' => 'surveillance.index', 'uses' => 'SurveillanceController@index']);

        Route::get('/create', ['as' => 'surveillance.create', 'uses' => 'SurveillanceController@create']);
        Route::post('/create', ['as' => 'surveillance.create', 'uses' => 'SurveillanceController@store']);

        Route::get('/show/{id}', ['as' => 'surveillance.show', 'uses' => 'SurveillanceController@show']);

        Route::get('/edit/{id}', ['as' => 'surveillance.edit', 'uses' => 'SurveillanceController@edit']);
        Route::post('/edit/{id}', ['as' => 'surveillance.edit', 'uses' => 'SurveillanceController@update']);

        Route::get('/pdf/{id}/{download}', ['as' => 'surveillance.pdf', 'uses' => 'SurveillanceController@getPdf']);
        Route::get('/email/{id}', ['as' => 'surveillance.email', 'uses' => 'SurveillanceController@email']);
    });

    Route::group(['prefix' => 'evidence'], function () {
        Route::post('upload/surveillance', ['as' => 'file.upload.surveillance', 'uses' => 'EvidenceController@uploadSurveillance']);
    });

    Route::group(['prefix' => 'otrs'], function () {
        Route::get('/', ['as' => 'otrs.index', 'uses' => 'OtrsController@index']);
        Route::post('/customer/synch', ['as' => 'otrs.customer.synch', 'uses' => 'OtrsController@customerSynch']);
    });
});