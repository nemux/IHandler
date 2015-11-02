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
Route::model('user', 'Models\User\User');

Route::bind('user', function ($value, $route) {
    return App\Models\User\User::whereUsername($value)->first();
});


Route::get('/', ['as' => 'login.get', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('/', ['as' => 'login.post', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::get('/', ['as' => 'dashboard.index', 'uses' => 'DashboardController@index']);

    Route::group(['prefix' => 'incident'], function () {
        Route::get('/all', ['as' => 'incident.index', 'uses' => 'IncidentController@index']);
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', ['as' => 'user.index', 'uses' => 'UserController@index']);
        Route::get('/create', ['as' => 'user.create', 'uses' => 'UserController@create', 'middleware' => 'role:admin']);
        Route::post('/create', ['as' => 'user.create', 'uses' => 'UserController@store', 'middleware' => 'role:admin']);
        Route::get('/{user}', ['as' => 'user.show', 'uses' => 'UserController@show']);
        Route::get('/edit/{user}', ['as' => 'user.edit', 'uses' => 'UserController@edit', 'middleware' => 'role:admin']);
        Route::post('/edit/{user}', ['as' => 'user.update', 'uses' => 'UserController@update', 'middleware' => 'role:admin']);
        Route::delete('/{user}', ['as' => 'user.destroy', 'uses' => 'UserController@destroy', 'middleware' => 'role:admin']);

        Route::post('/changepass', ['as' => 'user.change_pass', 'uses' => 'UserController@changePass', 'middleware' => 'role:admin']);
    });

    Route::group(['prefix' => 'customer'], function () {
        Route::get('/', ['as' => 'customer.index', 'uses' => 'CustomerController@index']);
        Route::get('/create', ['as' => 'customer.create', 'uses' => 'CustomerController@create', 'middleware' => 'role:admin']);
        Route::post('/create', ['as' => 'customer.create', 'uses' => 'CustomerController@store', 'middleware' => 'role:admin']);
        Route::delete('/{id}', ['as' => 'customer.destroy', 'uses' => 'CustomerController@destroy', 'middleware' => 'role:admin']);
        Route::get('/{id}', ['as' => 'customer.show', 'uses' => 'CustomerController@show']);
        Route::get('/edit/{id}', ['as' => 'customer.edit', 'uses' => 'CustomerController@edit', 'middleware' => 'role:admin']);
        Route::post('/edit/{id}', ['as' => 'customer.update', 'uses' => 'CustomerController@update', 'middleware' => 'role:admin']);

        Route::group(['prefix' => 'asset'], function () {
            Route::post('/create', ['as' => 'asset.store', 'uses' => 'CustomerAssetController@store', 'middleware' => 'role:admin']);
            Route::get('/{id}', ['as' => 'asset.show', 'uses' => 'CustomerAssetController@show']);
            Route::get('/edit/{id}', ['as' => 'asset.edit', 'uses' => 'CustomerAssetController@edit', 'middleware' => 'role:admin']);
            Route::post('/edit/{id}', ['as' => 'asset.update', 'uses' => 'CustomerAssetController@update', 'middleware' => 'role:admin']);
            Route::delete('/{id}', ['as' => 'asset.destroy', 'uses' => 'CustomerAssetController@destroy', 'middleware' => 'role:admin']);
        });

        Route::group(['prefix' => 'employee'], function () {
            Route::get('/create/{customer_id}', ['as' => 'employee.create', 'uses' => 'CustomerEmployeeController@create']);
            Route::post('/create/{customer_id}', ['as' => 'employee.store', 'uses' => 'CustomerEmployeeController@store']);
            Route::get('/{id}', ['as' => 'employee.show', 'uses' => 'CustomerEmployeeController@show']);
            Route::get('/edit/{id}', ['as' => 'employee.edit', 'uses' => 'CustomerEmployeeController@edit', 'middleware' => 'role:admin']);
            Route::post('/edit/{id}', ['as' => 'employee.update', 'uses' => 'CustomerEmployeeController@update', 'middleware' => 'role:admin']);
            Route::delete('/{id}', ['as' => 'employee.destroy', 'uses' => 'CustomerEmployeeController@destroy', 'middleware' => 'role:admin']);
        });

        Route::group(['prefix' => 'page'], function () {
            Route::post('/create', ['as' => 'customer.page.store', 'uses' => 'CustomerPageController@store', 'middleware' => 'role:admin']);
            Route::get('/{id}', ['as' => 'customer.page.show', 'uses' => 'CustomerPageController@show']);
            Route::get('/edit/{id}', ['as' => 'customer.page.edit', 'uses' => 'CustomerPageController@edit', 'middleware' => 'role:admin']);
            Route::post('/edit/{id}', ['as' => 'customer.page.update', 'uses' => 'CustomerPageController@update', 'middleware' => 'role:admin']);
            Route::delete('/{id}', ['as' => 'customer.page.destroy', 'uses' => 'CustomerPageController@destroy', 'middleware' => 'role:admin']);
        });

        Route::group(['prefix' => 'sensor'], function () {
            Route::post('/create', ['as' => 'sensor.store', 'uses' => 'CustomerSensorController@store', 'middleware' => 'role:admin']);
            Route::get('/{id}', ['as' => 'sensor.show', 'uses' => 'CustomerSensorController@show']);
            Route::get('/edit/{id}', ['as' => 'sensor.edit', 'uses' => 'CustomerSensorController@edit', 'middleware' => 'role:admin']);
            Route::post('/edit/{id}', ['as' => 'sensor.update', 'uses' => 'CustomerSensorController@update', 'middleware' => 'role:admin']);
            Route::delete('/{id}', ['as' => 'sensor.destroy', 'uses' => 'CustomerSensorController@destroy', 'middleware' => 'role:admin']);
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
        Route::get('/', ['as' => 'otrs.index', 'uses' => 'OtrsController@index', 'middleware' => 'role:admin']);
        Route::post('/customer/synch', ['as' => 'otrs.customer.synch', 'uses' => 'OtrsController@customerSynch', 'middleware' => 'role:admin']);
    });

    Route::group(['prefix' => 'attack', 'middleware' => 'role:admin'], function () {
        Route::get('/', ['as' => 'attack.index', 'uses' => 'AttackTypeController@index']);
        Route::get('/edit/{id}', ['as' => 'attack.edit', 'uses' => 'AttackTypeController@edit']);
        Route::post('/edit/{id}', ['as' => 'attack.edit', 'uses' => 'AttackTypeController@update']);
        Route::get('/create', ['as' => 'attack.create', 'uses' => 'AttackTypeController@create']);
        Route::post('/create', ['as' => 'attack.create', 'uses' => 'AttackTypeController@store']);
        Route::delete('/{id}', ['as' => 'attack.destroy', 'uses' => 'AttackTypeController@destroy']);
        Route::get('/show/{id}', ['as' => 'attack.show', 'uses' => 'AttackTypeController@show']);
    });

    Route::group(['prefix' => 'criticity', 'middleware' => 'role:admin'], function () {
        Route::get('/', ['as' => 'criticity.index', 'uses' => 'CriticityController@index']);
        Route::get('/edit/{id}', ['as' => 'criticity.edit', 'uses' => 'CriticityController@edit']);
        Route::post('/edit/{id}', ['as' => 'criticity.edit', 'uses' => 'CriticityController@update']);
        Route::get('/create', ['as' => 'criticity.create', 'uses' => 'CriticityController@create']);
        Route::post('/create', ['as' => 'criticity.create', 'uses' => 'CriticityController@store']);
        Route::delete('/{id}', ['as' => 'criticity.destroy', 'uses' => 'CriticityController@destroy']);
        Route::get('/show/{id}', ['as' => 'criticity.show', 'uses' => 'CriticityController@show']);
    });

    Route::group(['prefix' => 'flow', 'middleware' => 'role:admin'], function () {
        Route::get('/', ['as' => 'flow.index', 'uses' => 'AttackFlowController@index']);
        Route::get('/edit/{id}', ['as' => 'flow.edit', 'uses' => 'AttackFlowController@edit']);
        Route::post('/edit/{id}', ['as' => 'flow.edit', 'uses' => 'AttackFlowController@update']);
        Route::get('/create', ['as' => 'flow.create', 'uses' => 'AttackFlowController@create']);
        Route::post('/create', ['as' => 'flow.create', 'uses' => 'AttackFlowController@store']);
        Route::delete('/{id}', ['as' => 'flow.destroy', 'uses' => 'AttackFlowController@destroy']);
        Route::get('/show/{id}', ['as' => 'flow.show', 'uses' => 'AttackFlowController@show']);
    });

    Route::group(['prefix' => 'category', 'middleware' => 'role:admin'], function () {
        Route::get('/', ['as' => 'category.index', 'uses' => 'AttackCategoryController@index']);
        Route::get('/edit/{id}', ['as' => 'category.edit', 'uses' => 'AttackCategoryController@edit']);
        Route::post('/edit/{id}', ['as' => 'category.edit', 'uses' => 'AttackCategoryController@update']);
        Route::get('/create', ['as' => 'category.create', 'uses' => 'AttackCategoryController@create']);
        Route::post('/create', ['as' => 'category.create', 'uses' => 'AttackCategoryController@store']);
        Route::delete('/{id}', ['as' => 'category.destroy', 'uses' => 'AttackCategoryController@destroy']);
        Route::get('/show/{id}', ['as' => 'category.show', 'uses' => 'AttackCategoryController@show']);
    });

    Route::group(['prefix' => 'signature', 'middleware' => 'role:admin,coord'], function () {
        Route::get('/', ['as' => 'signature.index', 'uses' => 'AttackSignatureController@index']);
        Route::get('/edit/{id}', ['as' => 'signature.edit', 'uses' => 'AttackSignatureController@edit']);
        Route::post('/edit/{id}', ['as' => 'signature.edit', 'uses' => 'AttackSignatureController@update']);
        Route::get('/create', ['as' => 'signature.create', 'uses' => 'AttackSignatureController@create']);
        Route::post('/create', ['as' => 'signature.create', 'uses' => 'AttackSignatureController@store']);
        Route::delete('/{id}', ['as' => 'signature.destroy', 'uses' => 'AttackSignatureController@destroy']);
        Route::get('/show/{id}', ['as' => 'signature.show', 'uses' => 'AttackSignatureController@show']);
    });
});