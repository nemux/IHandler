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
  return Redirect::to('/login');
});
Route::get('rule/query/{id}', 'RuleController@query');


Route::get('login', 'LoginController@login');
Route::post('login', 'LoginController@doLogin');
Route::get('logout', function()
{
    Auth::logout();
    return Redirect::to('login');
});


Route::group(array('before'=>'admin', 'prefix'=>'handler'),function(){

  # User Routes
  Route::get('/', 'IncidentHandlerController@index');
  Route::get('create', 'IncidentHandlerController@create');
  Route::post('create', 'IncidentHandlerController@create');
  Route::get('update/{id}', 'IncidentHandlerController@getUpdate');
  Route::post('handler/update', 'IncidentHandlerController@postUpdate');
  Route::get('view/{id}', 'IncidentHandlerController@view');

  #Admin Routes
});

Route::group(array('before'=>'auth', 'prefix'=>'incident'),function(){
  Route::get('create', 'IncidentController@create');
  Route::post('create', 'IncidentController@create');

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
