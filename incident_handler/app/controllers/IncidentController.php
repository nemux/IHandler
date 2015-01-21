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
      $categories=Category::lists('name', 'id');
      $customer=Customer::lists('company', 'id');
      $rule=Rule::all();
      $references=new References;
      $occurences_types=OccurenceType::lists('name', 'id');

      $det_time=new Time;
      $occ_time=new Time;


      if ($input) {
        print_r($input);
        $incident->risk=$input['risk'];
        $incident->criticity=$input['criticity'];
        $incident->impact=$input['impact'];
        $incident->categories_id=$input['category_id'];
        $incident->attacks_id=$input['attack_id'];
        $incident->customers_id=$input['customers_id'];
        $incident->title=$input['title'];
        $incident->description=$input['description'];
        $incident->conclution=$input['conclution'];
        $incident->recomendation=$input['recomendation'];
        //$incident->incident_handler_id=Auth::user()->incident_handler_id;
        $incident->incident_handler_id='1';
        $incident->save();

        $det_time->datetime=$input['det_date'].' '.date("H:i:s",strtotime($input['det_time']));
        $det_time->zone="UTC/GMT -6 hora";
        $occ_time->datetime=$input['occ_date'].' '.date("H:i:s",strtotime($input['occ_time']));
        $occ_time->zone="UTC/GMT -6 hora";
        $det_time->time_types_id=1;
        $occ_time->time_types_id=2;
        $det_time->incidents_id=$incident->id;
        $occ_time->incidents_id=$incident->id;
        $det_time->save();
        $occ_time->save();

        $keys=array_keys($input);
        $events=array();
        foreach ($keys as $k) {
          if (strpos($k,'srcip') !== false) {
              array_push($events,explode('_',$k)[1]);
          }
        }
        foreach ($events as $e) {
          $occurence=new Occurence;


        }


      }
      else{
        //$this->layout = View::make("incidentHandler.create",array('handler' => $handler));
        return $this->layout = View::make("incident.form", array(
        'incident'=>$incident,
        'title'=>"Creación de Nuevo Incidente",
        'action'=>"IncidentController@create",
        'attack'=>$attack,
        'customer'=>$customer,
        'rule'=>$rule,
        'references'=>$references,
        'categories'=>$categories,
        'occurences_types'=>$occurences_types,
        ));
      }

    }




}


 ?>
