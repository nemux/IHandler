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
Route::get('login', 'LoginController@login');

Route::post('dologin', 'LoginController@doLogin');


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

Route::filter('noAuth', function()
{
    //si no ha iniciado sesión
    if(Auth::guest()){
        return Redirect::to('login');
    }
});

Route::get('/otrs/{name}',function($name)
{

  $o = new Otrs\Customer();
  $u = new Otrs\User();
  $t = new Otrs\Ticket();
  $a = new Otrs\Article();


  print_r($o->getAll());
  /*
  foreach ($u->getAll() as $k=>$v){
    print("[");
    print($k);
    print("]=>");
    foreach($v as $k2 => $v2){
      print("[");
      print($k2);
      print("]=>");
      print($v2);
      print("<br/>");
    }
    //print_r($v);
    print("<br/>");
  }
  */
  /*
  print_r($u->getUserInfo($name));

  foreach($u->getUserInfo($name) as $k=>$v){
     print("[");
      print($k);
      print("]=>");
      print($v);
      print("<br/>");
  }
  */


  /*
  $ticket_info = $t->createTicket("Ticket desde Laravel", 3, "ldeleon", "Probando la creacion de tickets desde Laravel, intento 2");
  foreach($ticket_info as $k=>$v){
      print("[");
      print($k);
      print("]=>");
      print($v);
      print("<br/>");
  }
  */

  //print_r($a->createArticle(21, 3, "juas@juas.com", "Poniendo otro articulo juas, juas", "nemux", "A ver si jala esta madre y no se truena"));

  //$nombre = $o->getCustomerById($name);
  //print_r($nombre);
  //$d = $o->getCustomerInfo($name);
  //print_r($d);
  //return array("function"=>'get/otrs');
});
