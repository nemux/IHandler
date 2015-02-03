<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
    if (Auth::check())
      return Redirect::to('/dashboard');
    else
      return View::make('usuarios.login');
	}

  public function dashboard()
  {
		$date_minor= date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' - 3 hour'));
		$notification=Observation::where('incident_handler_id','=',Auth::user()->id)->where('created_at','>=',$date_minor)->get();
    return View::make('usuarios.dashboard',array('notification'=>$notification));
  }
}
