<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::get('dashboard', array('before' => 'auth', 'uses' => 'HomeController@dashboard'));
Route::post('dashboard/update/observations', array('before' => 'auth', 'uses' => 'HomeController@updateObservations'));
Route::post('dashboard/update/closures', array('before' => 'auth', 'uses' => 'HomeController@updateClosures'));
Route::post('dashboard/update/notifications', array('before' => 'auth', 'uses' => 'HomeController@updateNotifications'));
Route::post('dashboard/get/alerts', array('before' => 'auth', 'uses' => 'HomeController@getAlerts'));

Route::get('rule/query/{id}', 'RuleController@query')->where(array('id' => '^[0-9]+$'));
Route::get('occurence/query/{id}', 'OccurenceController@query')->where(array('id' => '^[0-9]+$'));

/**
 * Rutas para el Mapa
 */
Route::get('dashboard/map', ['before' => 'auth', 'uses' => 'MapController@index']);
Route::get('dashboard/map/locate/{ip}', ['before' => 'auth', 'uses' => 'MapController@locate']);
Route::get('dashboard/map/location', ['before' => 'auth', 'uses' => 'MapController@myLocation']);
Route::get('dashboard/map/location/{ip}', ['before' => 'auth', 'uses' => 'MapController@location']);
Route::get('dashboard/map/broadcastLocations', ['before' => 'auth', 'uses' => 'MapController@broadcastLocations']);
Route::post('dashboard/map/incidents', ['before' => 'auth', 'uses' => 'MapController@getIncidents']);

Route::get('login', 'LoginController@login');
Route::post('login', 'LoginController@doLogin');
Route::get('logout', 'LoginController@logout');


Route::group(array('before' => 'admin', 'prefix' => 'handler'), function () {

    # User Routes
    Route::get('/', 'IncidentHandlerController@index');
    Route::get('create', 'IncidentHandlerController@create');
    Route::post('create', 'IncidentHandlerController@create');
    Route::get('update/{id}', 'IncidentHandlerController@getUpdate')->where(array('id' => '^[0-9]+$'));
    Route::post('update', 'IncidentHandlerController@postUpdate');
    Route::get('view/{id}', 'IncidentHandlerController@view')->where(array('id' => '^[0-9]+$'));

    // Route::get('larala','IncidentHandlerController@aproved');
    #Admin Routes
});
Route::post('handler/update/password', 'IncidentHandlerController@passwordUpdate');
Route::post('handler/send/token', 'IncidentHandlerController@sendToken');

Route::group(array('before' => 'admin', 'prefix' => 'sensor'), function () {

    # User Routes
    Route::get('/', 'SensorController@index');
    Route::get('create', 'SensorController@create');
    Route::post('create', 'SensorController@create');
    Route::get('update/{id}', 'SensorController@getUpdate')->where(array('id' => '^[0-9]+$'));
    Route::post('update', 'SensorController@postUpdate');
    Route::get('view/{id}', 'SensorController@view')->where(array('id' => '^[0-9]+$'));

    #Admin Routes
});

Route::group(array('before' => 'auth', 'prefix' => 'incident'), function () {
    Route::get('/', 'IncidentController@index');
    Route::get('create', 'IncidentController@create');
    Route::post('create', 'IncidentController@create');
    Route::get('update/{id}', 'IncidentController@getUpdate')->where(array('id' => '^[0-9]+$'));
    Route::post('update', 'IncidentController@postUpdate');
    Route::post('updateStatus', 'IncidentController@updateStatus');
    Route::get('manage/{id}', 'IncidentController@edit');
    Route::post('manage', 'IncidentController@change_status');
    Route::get('pdf/{id}', 'IncidentController@pdf');
    Route::get('doc/{id}', 'IncidentController@doc');
    Route::get('doc', 'IncidentController@docReport');
    Route::post('add/recomendation', 'IncidentController@addRecomendation');
    Route::post('add/Observation', 'IncidentController@addObservation');
    Route::get('open/', 'IncidentController@openStatus');
    Route::get('investigation/', 'IncidentController@investigationStatus');
    Route::get('solved/', 'IncidentController@solvedStatus');
    Route::get('solved/all', 'IncidentController@allSolvedStatus');
    //Route::get('show/{id}', 'IncidentController@pdf');
    Route::get('sensor/get/{id}', 'SensorController@customerSensor');
    Route::post('add/Annex', 'IncidentController@addAnnex');
    Route::post('change/toFalsoPositivo', 'IncidentController@changeToFalsoPositivo'); //Cambia un incidente a Falso Positivo adjuntando una imagen
    Route::get('del/Annex/{id}', 'IncidentController@delAnnex');
    Route::get('search/ip/', 'IncidentController@searchIp');
    Route::post('search/render/ip/', 'IncidentController@renderIp');
    Route::get('mail/{id}', 'IncidentController@mail');

    Route::get('view/filter/', 'IncidentController@monthly');
    Route::post('view/filter/', 'IncidentController@viewMonthly');

    Route::get('view/sensor/', 'IncidentController@sensor');
    Route::post('view/sensor/', 'IncidentController@viewSensor');

    Route::get('rules/', 'IncidentController@rules');

    Route::post('observation/read', 'IncidentController@readObservation');
    Route::post('observation/attend', 'IncidentController@attendObservation');
});

Route::group(array('before' => 'admin', 'prefix' => 'signatures'), function () {
    Route::get('/', ['as' => 'signatures.index', 'uses' => 'SignatureController@index']);
    Route::post('/create', 'SignatureController@store');
});

Route::group(array('before' => 'admin', 'prefix' => 'customer'), function () {

    # User Routes
    Route::get('/', 'CustomerController@index');
    Route::get('create', 'CustomerController@create');
    Route::post('create', 'CustomerController@create');
    Route::get('update/{id}', 'CustomerController@getUpdate')->where(array('id' => '^[0-9]+$'));
    Route::post('update', 'CustomerController@postUpdate');
    Route::get('view/{id}', 'CustomerController@view')->where(array('id' => '^[0-9]+$'));
    Route::post('importCustomers', 'OtrsController@importCustomers');

    #Store data of Customer
    Route::post('store/asset', 'CustomerController@storeAsset');
    Route::post('store/employee', 'CustomerController@storeEmployee');
    Route::post('store/page', 'CustomerController@storePage');
    Route::post('store/socialmedia', 'CustomerController@storeSocialmedia');

    #Catalogs
//    Route::get('catalog/page_type', 'CustomerController@pageTypes');

    #Admin Routes


});


Route::group(array('before' => 'auth', 'prefix' => 'stats'), function () {
    # User Routes
    Route::get('/incident', 'StatsController@incident');
    Route::post('/incident/graph', 'StatsController@incidentGraph');
    Route::get('/ip', 'StatsController@ip');
    Route::post('/ip/graph', 'StatsController@ipGraph');
    Route::get('/attack', 'StatsController@attack');
    Route::post('/attack/graph', 'StatsController@attackGraph');
    Route::get('/category', 'StatsController@category');
    Route::post('/category/graph', 'StatsController@categoryGraph');
    Route::get('/handler', 'StatsController@handler');
    Route::post('/handler/graph', 'StatsController@handlerGraph');
    Route::get('/severity', 'StatsController@severity');
    Route::post('/severity/graph', 'StatsController@severityGraph');

    Route::get('/sensor', 'StatsController@sensor'); //Obtiene la vista de estadísticas por sensor
    Route::post('/sensor/graph', 'StatsController@sensorGraph'); //Envía la información para generar las gráficas por sensor

    Route::get('/sensor/severity', 'StatsController@sensorSeverity'); //Obtiene la vista de estadísticas por sensor y severidad
    Route::post('/sensor/severity/graph', 'StatsController@sensorSeverityGrahp'); //Envía la información para generar las gráficas por sensor y severidad

    Route::get('/ip/ie', 'StatsController@ipIE'); //Obtiene la vista de estadísticas por IP Interna o Externa
    Route::post('/ip/ie/graph', 'StatsController@ipIEGraph'); //Envía la información para generar las gráfticas por IP Interna o Externa
    Route::get('/ip/ie/doc', 'StatsController@ipIEDoc'); //Genera el documento de la lista de IPs encontradas

    Route::get('/blacklist', 'StatsController@blacklist');
    Route::get('/blacklist/doc', 'StatsController@doc');

    Route::post('/ip/origin', 'StatsController@post_IPListByOrigin');
    Route::get('/ip/origin', 'StatsController@get_IPListByOrigin');

    Route::get('/stream', 'StatsController@stream');
    Route::post('/stream/graph', 'StatsController@streamGraph');
    #Admin Routes
});

Route::get('incident/view/{id}', 'IncidentController@view');

Route::group(array('before' => 'admin', 'prefix' => 'attack'), function () {
    Route::get('create', 'AttackController@get_create');
    Route::post('create', 'AttackController@post_create');
    Route::get('/', 'AttackController@index');
    Route::get('/{id}', 'AttackController@get_byID');
    Route::get('view/{id}', 'AttackController@view');
    Route::get('update/{id}', 'AttackController@get_update');
    Route::post('update', 'AttackController@post_update');
});


Route::group(array('before' => 'auth', 'prefix' => 'report'), function () {
    # Report Routes
    Route::get('/', 'ReportController@index');
    Route::get('/{type}', 'ReportController@view')->where(array('type' => '(date|handler|category|severity|status|ip|csv)'));
    Route::post('/create/{doc_type}', 'ReportController@create')->where(array('doc_type' => '(doc|csv)'));
    Route::get('/ip/doc', 'ReportController@ipDoc');
});


Route::group(array('before' => 'admin', 'prefix' => 'otrs'), function () {
    Route::get('import', 'OtrsController@import');
    Route::get('result', 'OtrsController@result');
});

Route::group(array('prefix' => 'api'), function () {
    Route::group(array('prefix' => '1.1'), function () {
        Route::group(array('prefix' => 'task'), function () {
            Route::post('/ticket/reminder', 'TaskController@sendReminder');
            Route::post('/ticket/close', 'TaskController@closeTickets');
            Route::get('/otrs/ticket/create/{key}/{id}', 'OtrsController@sendTicket');
        });
    });
});
