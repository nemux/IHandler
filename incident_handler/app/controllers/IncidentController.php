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
      $attack=Attack::lists('name', 'id');
      $customer=Customer::lists('company', 'id');

      if ($input) {
        print_r($input);
      }
      else{
        //$this->layout = View::make("incidentHandler.create",array('handler' => $handler));
        return $this->layout = View::make("incident.form", array(
        'incident'=>$incident,
        'title'=>"Creación de Nuevo Incidente",
        'action'=>"IncidentController@create",
        'attack'=>$attack,
        'customer'=>$customer,

        ));
      }

    }




}


 ?>
