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
		$notification=Observation::where('incident_handler_id','=',Auth::user()->id)->where('readed','!=',1)->get();
		return View::make('usuarios.dashboard',array('notification'=>$notification));
  }
  public function updateObservations(){
  		$history_notification=Observation::where('incident_handler_id','=',Auth::user()->id)
  							->orderBy('created_at', 'desc')
  							->take(20)
  							->get();
  		$notification=Observation::where('incident_handler_id','=',Auth::user()->id)->where('readed','!=',1)->get();
  		return View::make('usuarios.observations',array('history_notification'=>$history_notification,'notification'=>$notification));
	    //return date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' - 5 days'));
		//,'closure'=>$closure,'history_notification'=>$history_notification
  }
  public function updateClosures(){
  		$closure=Incident::where('updated_at','<',date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' - 5 days')))
							//->where('incidents_status_id','>=','2')
							->where('incidents_status_id','=','3')
							->where("customers_id","!=","2")
							->get();
		return View::make('usuarios.closures',array('closure'=>$closure));
  }
  public function updateNotifications(){
  		$notifications=Notification::where("content","!=","")->orderBy('created_at', 'desc')->take(100)->get();
  		return View::make('usuarios.notifications',array('notifications'=>$notifications));
  }
}
