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

Route::get('/', function()
{
	return View::make('layouts.master');
	  //return Redirect::to('usuarios');
});

Route::get('handler', 'IncidentHandlerController@index');

Route::get('handler/create', 'IncidentHandlerController@create');
Route::post('handler/create', 'IncidentHandlerController@create');

Route::get('handler/update/{id}', 'IncidentHandlerController@getUpdate');
Route::post('handler/update', 'IncidentHandlerController@postUpdate');

Route::get('handler/view/{id}', 'IncidentHandlerController@view');

Route::get('handler', 'IncidentHandlerController@index');


Route::get('incident/create', 'IncidentController@create');
Route::post('incident/create', 'IncidentController@create');
