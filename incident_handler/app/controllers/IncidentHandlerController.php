<?php

class IncidentHandlerController extends Controller {
protected $layout = 'layouts.master';
    /**
     * Muestra el perfil de un usuario dado.
     */
    public function create()
    {
      $input = Input::all();
      $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      $handler=new IncidentHandler;
      $access=new Access;
      $types=AccessType::lists('name', 'id');

      if ($input) {
        $handler->name=$input['name'];
        $handler->lastname=$input['lastname'];
        $handler->phone=$input['phone'];
        $handler->mail=$input['mail'];
        $handler->save();

        $access->username=$input['username'];
        $access->password=substr(str_shuffle($chars),0,8);
        $access->access_types_id=$input['access_types_id'];
        $access->incident_handler_id=$handler->id;
        $access->active=0;
        $access->save();
        $log->info(Auth::user()->id,Auth::user()->username,'Se creó el Incident Handler con ID: '. $handler->id);
        return Redirect::to('handler/view/'.$handler->id);
      }
      else{
        //$this->layout = View::make("incidentHandler.create",array('handler' => $handler));
        return $this->layout = View::make("incidentHandler.form", array(
        'handler'=>$handler,
        'access'=>$access,
        'types'=>$types,
        'action'=>'IncidentHandlerController@create',
        'title'=>"Nuevo Incident Handler",
        ));
      }

    }

    public function postUpdate()
    {
      $input = Input::all();
      //$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      $id=$input['id'];
      $handler=IncidentHandler::find($id);
      $access=$handler->access;
      $types=AccessType::lists('name', 'id');

      if ($input) {
        $handler->name=$input['name'];
        $handler->lastname=$input['lastname'];
        $handler->phone=$input['phone'];
        $handler->mail=$input['mail'];
        $handler->save();

        $access->username=$input['username'];
        //$access->pass=substr(str_shuffle($chars),0,8);
        $access->access_types_id=$input['access_types_id'];
        $access->incident_handler_id=$handler->id;
        $access->active=0;
        $access->save();

        $log->info(Auth::user()->id,Auth::user()->username,'Se actualizó el Incident Handler con ID: '. $handler->id);
        return Redirect::to('handler/view/'.$handler->id);
      }


    }
    public function getUpdate($id){

        $handler=IncidentHandler::find($id);
        $access=$handler->access;
        $types=AccessType::lists('name', 'id');
        return $this->layout = View::make("incidentHandler.form", array(
        'handler'=>$handler,
        'access'=>$access,
        'types'=>$types,
        'action'=>'IncidentHandlerController@postUpdate',
        'update'=>'update',
        'title'=>'Actualización de Incident Handler'
        ));

    }

    public function view($id)
    {
      //$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      $handler=IncidentHandler::find($id);
      $access=Access::where('incident_handler_id','=',$id)->first();
      $types=AccessType::lists('name', 'id');


      return $this->layout = View::make('incidentHandler.view', array(
        'handler'=>$handler,
        'access'=>$access,
        'types'=>$types,

        ));


    }
    public function index(){
      $handler=IncidentHandler::all();
      return $this->layout = View::make('incidentHandler.index', array(
        'handler'=>$handler,

        ));
    }

  /**
   * Setup the layout used by the controller.
   *
   * @return void
   */

}
