<?php

class IncidentController extends Controller {
protected $layout = 'layouts.master';
    /**
     * Muestra el perfil de un usuario dado.
     */
    public function create()
    {
      $input = Input::all();
      $incident=new Incident;

      if ($input) {

      }
      else{
        //$this->layout = View::make("incidentHandler.create",array('handler' => $handler));
        return $this->layout = View::make("incident.form", array(
        'incident'=>$incident,
        'title'=>"Creación de Nuevo Incidente",
        'action'=>"IncidentController@create",

        ));
      }

    }




}


 ?>
