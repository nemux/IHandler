<?php

class ApprovedController extends Controller {
protected $layout = 'layouts.master';
    /**
     * Muestra el perfil de un usuario dado.
     */

    public function postUpdate()
    {
      $input = Input::all();
      //$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      $id=$input['id'];
      $incident=Incident::find($id);
      $access=$handler->access;
      $types=AccessType::lists('name', 'id');

      if ($input) {
        $handler->conclution=$input['conclution'];
        $handler->recomendation=$input['recomendation'];
       //$handler->phone=$input['conclution'];
        //$handler->mail=$input['mail'];
        $handler->save();
        return Redirect::to('approved/approved/'.$handler->id);
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

    

    public function change()
    {
      return View::make('/');
    }


    public function edit($id)
    {
      $incident = Incident::find($id);
      return View::make('approved.approved')->with('incident', $incident);
    }

    public function view($id)
    {
      //$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      $incident=Incident::find($id);


      return $this->layout = View::make('approved.approved', array(
        'incient'=>$incident,

        'action'=>'ApprovedController@getUpdate',
        ));
    }

  /**
   * Setup the layout used by the controller.
   *
   * @return void
   */

}
