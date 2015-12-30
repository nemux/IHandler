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
 * Muestra en el LOG de Laravel las queries ejecutadas. Útil para debugear
 */
Event::listen('illuminate.query', function ($sql, $bindings) {

    foreach ($bindings as $val) {
        $sql = preg_replace('/\?/', "'{$val}'", $sql, 1);
    }

    \Log::info($sql);
    \Log::info("-------------------------------------------------------------------------------------------------------");
});


/**
 * Esto permite pasar Objetos a las rutas, en lugar de IDs
 */
Route::model('user', \App\Models\User\User::class);
Route::model('customer_user', \App\Models\Helpdesk\CustomerUser::class);

Route::bind('user', function ($value, $route) {
    $user = App\Models\User\User::whereUsername($value)->first();

    if (!$user) {
        abort(404, 'No se encontró al usuario que se buscaba');
    }

    return $user;
});

Route::bind('customer_user', function ($value, $route) {
    $user = \App\Models\Helpdesk\CustomerUser::whereUsername($value)->first();

    if (!$user) {
        abort(404, 'No se encontró al usuario que se buscaba');
    }

    return $user;
});


Route::get('/', ['as' => 'login.get', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('/', ['as' => 'login.post', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::get('/', ['as' => 'dashboard.index', 'uses' => 'DashboardController@index']);

    Route::group(['prefix' => 'incident'], function () {
        Route::get('/', ['as' => 'incident.index', 'uses' => 'IncidentController@index']);
        Route::get('/create', ['as' => 'incident.create', 'uses' => 'IncidentController@create']);
        Route::post('/create', ['as' => 'incident.create', 'uses' => 'IncidentController@store']);
        Route::get('/show/{id}', ['as' => 'incident.show', 'uses' => 'IncidentController@show']);

        Route::get('/edit/{id}', ['as' => 'incident.edit', 'uses' => 'IncidentController@edit']);
        Route::post('/edit/{id}', ['as' => 'incident.edit', 'uses' => 'IncidentController@update']);

        Route::get('/pdf/{id}/{download}', ['as' => 'incident.pdf', 'uses' => 'IncidentController@getPdf']);
        Route::get('/doc/{id}', ['as' => 'incident.doc', 'uses' => 'IncidentController@getDoc']);
        Route::get('/email/{id}', ['as' => 'incident.email', 'uses' => 'IncidentController@email']);

        Route::get('/preview/{id}', ['as' => 'incident.preview', 'uses' => 'IncidentController@preview']);

        Route::delete('/delete/evidence/{incidentevidenceid}', ['as' => 'incident.evidence.delete', 'uses' => 'IncidentController@deleteEvidence']);
        Route::delete('/delete/event/{incidentId}/{sourceId}/{targetId}', ['as' => 'incident.event.delete', 'uses' => 'IncidentController@deleteEvent']);

        Route::patch('/edit/evidence', ['as' => 'incident.evidence.edit', 'uses' => 'IncidentController@updateEvidence']);

        Route::post('/change/status', ['as' => 'incident.change.status', 'uses' => 'IncidentController@changeStatus']);

        Route::post('/annex/create', ['as' => 'incident.annex.store', 'uses' => 'IncidentController@storeAnnex']);

        Route::post('/note/create', ['as' => 'incident.note.store', 'uses' => 'IncidentController@storeNote']);
        Route::delete('/note/delete', ['as' => 'incident.note.delete', 'uses' => 'IncidentController@deleteNote']);

        Route::get('/search', ['as' => 'incident.search', 'uses' => 'SearchEngineController@incident']);
        Route::post('/search', ['as' => 'incident.search.post', 'uses' => 'SearchEngineController@incidentSearch']);
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

    Route::group(['prefix' => 'helpdesk/user', 'middleware' => 'role:admin'], function () {
        Route::get('/', ['as' => 'helpdesk.user.index', 'uses' => 'Helpdesk\HelpdeskUserController@index']);
        Route::get('/create', ['as' => 'helpdesk.user.create', 'uses' => 'Helpdesk\HelpdeskUserController@create']);
        Route::post('/create', ['as' => 'helpdesk.user.create', 'uses' => 'Helpdesk\HelpdeskUserController@store']);
        Route::get('/{customer_user}', ['as' => 'helpdesk.user.show', 'uses' => 'Helpdesk\HelpdeskUserController@show']);
        Route::get('/edit/{customer_user}', ['as' => 'helpdesk.user.edit', 'uses' => 'Helpdesk\HelpdeskUserController@edit']);
        Route::post('/edit/{customer_user}', ['as' => 'helpdesk.user.update', 'uses' => 'Helpdesk\HelpdeskUserController@update']);
        Route::delete('/{customer_user}', ['as' => 'helpdesk.user.destroy', 'uses' => 'Helpdesk\HelpdeskUserController@destroy']);

        Route::post('/changepass', ['as' => 'helpdesk.user.change_pass', 'uses' => 'Helpdesk\HelpdeskUserController@changePass']);
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
        Route::get('/doc/{id}', ['as' => 'surveillance.doc', 'uses' => 'SurveillanceController@getDoc']);
        Route::get('/email/{id}', ['as' => 'surveillance.email', 'uses' => 'SurveillanceController@email']);

        Route::get('/preview/{id}', ['as' => 'incident.preview', 'uses' => 'SurveillanceController@preview']);
    });

    Route::group(['prefix' => 'evidence'], function () {
        Route::post('upload/surveillance', ['as' => 'file.upload.surveillance', 'uses' => 'EvidenceController@uploadSurveillance']);
        Route::post('upload/incident', ['as' => 'file.upload.incident', 'uses' => 'EvidenceController@uploadIncident']);
    });

    Route::group(['prefix' => 'otrs'], function () {
        Route::get('/', ['as' => 'otrs.index', 'uses' => 'OtrsController@index', 'middleware' => 'role:admin']);
        Route::post('/customer/synch', ['as' => 'otrs.customer.synch', 'uses' => 'OtrsController@customerSynch', 'middleware' => 'role:admin']);
    });

    Route::group(['prefix' => 'attack'], function () {//, 'middleware' => 'role:admin'
        Route::get('/', ['as' => 'attack.index', 'uses' => 'AttackTypeController@index']);
        Route::get('/edit/{id}', ['as' => 'attack.edit', 'uses' => 'AttackTypeController@edit', 'middleware' => 'role:admin']);
        Route::post('/edit/{id}', ['as' => 'attack.edit', 'uses' => 'AttackTypeController@update', 'middleware' => 'role:admin']);
        Route::get('/create', ['as' => 'attack.create', 'uses' => 'AttackTypeController@create', 'middleware' => 'role:admin']);
        Route::post('/create', ['as' => 'attack.create', 'uses' => 'AttackTypeController@store', 'middleware' => 'role:admin']);
        Route::delete('/{id}', ['as' => 'attack.destroy', 'uses' => 'AttackTypeController@destroy', 'middleware' => 'role:admin']);
        Route::get('/show/{id}', ['as' => 'attack.show', 'uses' => 'AttackTypeController@show']);
    });

    Route::group(['prefix' => 'criticity'], function () {
        Route::get('/', ['as' => 'criticity.index', 'uses' => 'CriticityController@index']);
        Route::get('/edit/{id}', ['as' => 'criticity.edit', 'uses' => 'CriticityController@edit', 'middleware' => 'role:admin']);
        Route::post('/edit/{id}', ['as' => 'criticity.edit', 'uses' => 'CriticityController@update', 'middleware' => 'role:admin']);
        Route::get('/create', ['as' => 'criticity.create', 'uses' => 'CriticityController@create', 'middleware' => 'role:admin']);
        Route::post('/create', ['as' => 'criticity.create', 'uses' => 'CriticityController@store', 'middleware' => 'role:admin']);
        Route::delete('/{id}', ['as' => 'criticity.destroy', 'uses' => 'CriticityController@destroy', 'middleware' => 'role:admin']);
        Route::get('/show/{id}', ['as' => 'criticity.show', 'uses' => 'CriticityController@show']);
    });

    Route::group(['prefix' => 'flow'], function () {
        Route::get('/', ['as' => 'flow.index', 'uses' => 'AttackFlowController@index']);
        Route::get('/edit/{id}', ['as' => 'flow.edit', 'uses' => 'AttackFlowController@edit', 'middleware' => 'role:admin']);
        Route::post('/edit/{id}', ['as' => 'flow.edit', 'uses' => 'AttackFlowController@update', 'middleware' => 'role:admin']);
        Route::get('/create', ['as' => 'flow.create', 'uses' => 'AttackFlowController@create', 'middleware' => 'role:admin']);
        Route::post('/create', ['as' => 'flow.create', 'uses' => 'AttackFlowController@store', 'middleware' => 'role:admin']);
        Route::delete('/{id}', ['as' => 'flow.destroy', 'uses' => 'AttackFlowController@destroy', 'middleware' => 'role:admin']);
        Route::get('/show/{id}', ['as' => 'flow.show', 'uses' => 'AttackFlowController@show']);
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', ['as' => 'category.index', 'uses' => 'AttackCategoryController@index']);
        Route::get('/edit/{id}', ['as' => 'category.edit', 'uses' => 'AttackCategoryController@edit', 'middleware' => 'role:admin']);
        Route::post('/edit/{id}', ['as' => 'category.edit', 'uses' => 'AttackCategoryController@update', 'middleware' => 'role:admin']);
        Route::get('/create', ['as' => 'category.create', 'uses' => 'AttackCategoryController@create', 'middleware' => 'role:admin']);
        Route::post('/create', ['as' => 'category.create', 'uses' => 'AttackCategoryController@store', 'middleware' => 'role:admin']);
        Route::delete('/{id}', ['as' => 'category.destroy', 'uses' => 'AttackCategoryController@destroy', 'middleware' => 'role:admin']);
        Route::get('/show/{id}', ['as' => 'category.show', 'uses' => 'AttackCategoryController@show']);
    });

    Route::group(['prefix' => 'signature'], function () {
        Route::get('/', ['as' => 'signature.index', 'uses' => 'AttackSignatureController@index']);
        Route::get('/edit/{id}', ['as' => 'signature.edit', 'uses' => 'AttackSignatureController@edit', 'middleware' => 'role:admin,user_1']);
        Route::post('/edit/{id}', ['as' => 'signature.edit', 'uses' => 'AttackSignatureController@update', 'middleware' => 'role:admin,user_1']);
        Route::get('/create', ['as' => 'signature.create', 'uses' => 'AttackSignatureController@create', 'middleware' => 'role:admin,user_1']);
        Route::post('/create', ['as' => 'signature.create', 'uses' => 'AttackSignatureController@store', 'middleware' => 'role:admin,user_1']);
        Route::delete('/{id}', ['as' => 'signature.destroy', 'uses' => 'AttackSignatureController@destroy', 'middleware' => 'role:admin']);
        Route::get('/show/{id}', ['as' => 'signature.show', 'uses' => 'AttackSignatureController@show']);
        Route::get('/json/{id}', ['as' => 'signature.json', 'uses' => 'AttackSignatureController@getSignature']);
    });

    Route::group(['prefix' => 'machine'], function () {
        Route::get('blacklist', ['as' => 'machine.blacklist', 'uses' => 'MachineController@blacklist']);
    });

    /**
     * WebServices para obtener datos en formato Json
     */
    Route::group(['prefix' => 'ws', 'middleware' => 'auth'], function () {
        Route::get('/sensors/{id}', ['as' => 'ws.getSensors', 'uses' => 'CustomerSensorController@getSensors']);
    });

    Route::group(['prefix' => 'stats', 'middleware' => 'auth'], function () {
        Route::get('/', ['as' => 'stats.index', 'uses' => 'StatisticsController@index']);

        Route::get('/customer', ['as' => 'stats.customer', 'uses' => 'StatisticsController@customer']);
        Route::post('/customer', ['as' => 'stats.customer.post', 'uses' => 'StatisticsController@customerIncidents']);

        Route::get('/eventside', ['as' => 'stats.eventside', 'uses' => 'StatisticsController@eventsideIncidents']);
        Route::post('/eventside', ['as' => 'stats.eventside.post', 'uses' => 'StatisticsController@eventsideIncidentsPost']);

        Route::get('/handler', ['as' => 'stats.handler', 'uses' => 'StatisticsController@handlerIncidents']);
        Route::post('/handler', ['as' => 'stats.handler.post', 'uses' => 'StatisticsController@handlerIncidentsPost']);

        Route::get('/category', ['as' => 'stats.category', 'uses' => 'StatisticsController@categoryIncidents']);
        Route::post('/category', ['as' => 'stats.category.post', 'uses' => 'StatisticsController@categoryIncidentsPost']);

        Route::get('/criticity', ['as' => 'stats.criticity', 'uses' => 'StatisticsController@criticityIncidents']);
        Route::post('/criticity', ['as' => 'stats.criticity.post', 'uses' => 'StatisticsController@criticityIncidentsPost']);

        Route::get('/attacktype', ['as' => 'stats.attacktype', 'uses' => 'StatisticsController@attacktypeIncidents']);
        Route::post('/attacktype', ['as' => 'stats.attacktype.post', 'uses' => 'StatisticsController@attacktypeIncidentsPost']);

        Route::get('/sensor', ['as' => 'stats.sensor', 'uses' => 'StatisticsController@sensorIncidents']);
        Route::post('/sensor', ['as' => 'stats.sensor.post', 'uses' => 'StatisticsController@sensorIncidentsPost']);

        Route::get('/attackflow', ['as' => 'stats.attackflow', 'uses' => 'StatisticsController@attackflowIncidents']);
        Route::post('/attackflow', ['as' => 'stats.attackflow.post', 'uses' => 'StatisticsController@attackflowIncidentsPost']);

        Route::get('/machinetype', ['as' => 'stats.machinetype', 'uses' => 'StatisticsController@machinetypeIncidents']);
        Route::post('/machinetype', ['as' => 'stats.machinetype.post', 'uses' => 'StatisticsController@machinetypeIncidentsPost']);
    });

    Route::group(['prefix' => 'report', 'middleware' => 'auth'], function () {
        Route::get('/incident/{report_type}', ['as' => 'report.incident', 'uses' => 'ReportController@incidentReport']);
        Route::post('/incident/{report_type}', ['as' => 'report.incident.post', 'uses' => 'ReportController@incidentReportPost']);
    });

    Route::group(['prefix' => 'statistics', 'middleware' => 'auth'], function () {
//        Route::get('/incidents', ['as' => 'statistics.list', 'uses' => 'StatisticsController@listRoutes']);
        Route::get('/incidents/customer/{days}', ['as' => 'incidents.customer', 'uses' => 'StatisticsController@incidentsCustomer']);
        Route::get('/incidents/criticity/{days}', ['as' => 'incidents.criticity', 'uses' => 'StatisticsController@incidentsCricity']);
        Route::get('/incidents/category/{days}', ['as' => 'incidents.category', 'uses' => 'StatisticsController@incidentsCategory']);
        Route::get('/incidents/flow/{days}', ['as' => 'incidents.flow', 'uses' => 'StatisticsController@incidentsFlow']);
        Route::get('/incidents/type/{days}', ['as' => 'incidents.type', 'uses' => 'StatisticsController@incidentsType']);

        Route::get('/incidents/{take}', ['as' => 'incidents.take', 'uses' => 'StatisticsController@lastIncidents']);
        Route::get('/surveillances/{take}', ['as' => 'surveillances.take', 'uses' => 'StatisticsController@lastSurveillances']);
    });
});