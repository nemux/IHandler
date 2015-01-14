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

Route::get('/otrs/{name}',function($name)
{
  /*
  $o = new \app\lib\Otrs\Customer();
  $u = new \app\lib\Otrs\User();
  $t = new \app\lib\Otrs\Ticket();
  $a = new \app\lib\Otrs\Article();
  */

  //print_r($o->getAll());
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
  //print_r($u->getUserInfo($name));
  /*
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


});
