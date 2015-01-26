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



Route::get('/','HomeController@index');
Route::get('dashboard',array('before'=> 'auth', 'uses' => 'HomeController@dashboard'));
Route::get('rule/query/{id}', 'RuleController@query')->where(array('id'=>'^[0-9]+$'));
Route::get('occurence/query/{id}', 'OccurenceController@query')->where(array('id'=>'^[0-9]+$'));

Route::get('login','LoginController@login');
Route::post('login', 'LoginController@doLogin');
Route::get('logout', 'LoginController@logout');


Route::group(array('before'=>'admin', 'prefix'=>'handler'),function(){

  # User Routes
  Route::get('/', 'IncidentHandlerController@index');
  Route::get('create', 'IncidentHandlerController@create');
  Route::post('create', 'IncidentHandlerController@create');
  Route::get('update/{id}', 'IncidentHandlerController@getUpdate')->where(array('id'=>'^[0-9]+$'));
  Route::post('update', 'IncidentHandlerController@postUpdate');
  Route::get('view/{id}', 'IncidentHandlerController@view')->where(array('id'=>'^[0-9]+$'));
 // Route::get('larala','IncidentHandlerController@aproved');
  #Admin Routes
});


Route::group(array('before'=>'admin', 'prefix'=>'sensor'),function(){

  # User Routes
  Route::get('/', 'SensorController@index');
  Route::get('create', 'SensorController@create');
  Route::post('create', 'SensorController@create');
  Route::get('update/{id}', 'SensorController@getUpdate')->where(array('id'=>'^[0-9]+$'));
  Route::post('update', 'SensorController@postUpdate');
  Route::get('view/{id}', 'SensorController@view')->where(array('id'=>'^[0-9]+$'));

  #Admin Routes
});

Route::group(array('before'=>'auth', 'prefix'=>'incident'),function(){
  Route::get('/', 'IncidentController@index');
  Route::get('create', 'IncidentController@create');
  Route::post('create', 'IncidentController@create');
  Route::get('update/{id}', 'IncidentController@getUpdate')->where(array('id'=>'^[0-9]+$'));
  Route::post('update', 'IncidentController@postUpdate');
<<<<<<< HEAD
  Route::post('updateStatus', 'IncidentController@updateStatus');
  Route::get('manage/{id}', 'IncidentController@edit');
  Route::post('manage', 'IncidentController@change_status');
  Route::get('pdf/{id}', 'IncidentController@pdf');
=======
  Route::get('manage/{id}', 'ApprovedController@edit');
  Route::post('manage', 'ApprovedControllerller@change');
>>>>>>> 3dbff1f1009845963515c67c478ed0d49e2f330c

});

Route::get('incident/view/{id}','IncidentController@view');

Route::group(array('prefix'=>'report'),function(){

  # Report Routes
  Route::get('/', 'ReportController@index');
  Route::get('create', 'ReportController@index');
  Route::post('create', 'ReportController@postCreate');

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
