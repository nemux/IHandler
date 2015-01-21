<?php

class IncidentController extends Controller {
protected $layout = 'layouts.master';
    /**
     * Muestra el perfil de un usuario dado.
     */

    public function validateImage($image)
    {
      $input = array('image' => $image);
      $rules = array(
          'image' => 'image'
      );
      $validator = Validator::make($input, $rules);
      if ($validator->fails())
      {
          echo "1";
      } else{
          echo "0";
      }
    }

    public function validateRequired($input)
    {
      //echo $input['title']."<br>\n";
      $rules = array(
          'title' => 'required | regex:/^[A-Za-záéíóúÁÉÍÓÚ\_\,\;\!\?\"\:\-\(\)\#\=\.]+$/',
          'det_date' => 'required | regex:/^[0-9]{2}\-[0-9]{2}\-[0-9]{4}$/',
          'det_time' => 'required | regex:/^[0-9]{2}\s[0-9]{2}\s[AM|PM]$/',
          'occ_date' => 'required | regex:/^[0-9]{2}\-[0-9]{2}\-[0-9]{4}$/',
          'occ_time' => 'required | regex:/^[0-9]{2}\s[0-9]{2}\s[AM|PM]$/',
          'risk' => 'required | regex:/^[0-9]{2}$/',
          'criticity' => 'required | regex:/^[0-9]{2}$/',
          'impact' => 'required | regex:/^[0-9]{2}$/',
          'attack_id' => 'required | regex:/^[0-9]{5}$/',
          'category_id' => 'required | regex:/^[0-9]{5}$/',
          'customer_id' => 'required | regex:/^[0-9]{5}$/',
          'description' => 'required',
          'sensor_id' => 'required | regex:/^[0-9]{5}$/',
          'conclution' => 'required',
          'references' => 'required',
          'recomendations' => 'required'
      );
      $validator = Validator::make($input, $rules);
      if ($validator->fails())
      {
          echo "1";
      } else{
          echo "0";
      }
    }

    public function create()
    {
      $sensor_object= new Sensor;
      $input = Input::all();
      $incident=new Incident;
      $attack=Attack::lists('name', 'id');
      $categories=Category::lists('name', 'id');
      $customer=Customer::lists('company', 'id');
      $sensor=Sensor::lists('name', 'id');
      $rule=Rule::all();
      $references=new References;
      $occurences_types=OccurenceType::lists('name', 'id');

      $det_time=new Time;
      $occ_time=new Time;




      if ($input) {
        $keys=array_keys($input);
        //print_r($keys);
        $events=array();
        foreach ($keys as $k) {
          if (strpos($k,'srcip') !== false) {
              array_push($events,explode('_',$k)[1]);
          }
        }
        $rules=array();
        foreach ($keys as $k) {
          if (strpos($k,'sid') !== false) {
              array_push($rules,explode('_',$k)[1]);
          }
        }
        //validaciones
        $this->validateRequired($input);
        echo "\n<br>";
        foreach ($input['images'] as $im) {
          $this->validateImage($im);
          echo "\n<br>";
        }
        //validaciones

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
        $incident->incident_handler_id=Auth::user()->incident_handler_id;
        $incident->sensors_id=$input['sensor_id'];
        //$incident->incident_handler_id='1';
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


        foreach ($events as $e) {
          $src=new Occurence;
          $dst=new Occurence;

          $src_history=new OccurenceHistory;
          $dst_history=new OccurenceHistory;

          if($input['srcip_'.$e]=='')
            return "Ip no puede ir vacía";
          $src->ip=$input['srcip_'.$e];
          $src->occurrences_types_id=$input['srcoccurencestype_'.$e];
          $src->save();
          //'port','protocol','operative_system','function','datetime','occurences_id','incident_handler_id'
          $src_history->port=$input['srcport_'.$e];
          $src_history->protocol=$input['srcprotocol_'.$e];
          $src_history->operative_system=$input['srcoperativesystem_'.$e];
          $src_history->function=$input['srcfunction_'.$e];
          $src_history->datetime=date('Y-m-d H:i:s');
          $src_history->occurences_id=$src->id;
          $src_history->incident_handler_id=Auth::user()->incident_handler_id;
          $src_history->save();

          $dst->ip=$input['dstip_'.$e];
          $dst->occurrences_types_id=$input['dstoccurencestype_'.$e];
          $dst->save();
          //'port','protocol','operative_system','function','datetime','occurences_id','incident_handler_id'
          $dst_history->port=$input['dstport_'.$e];
          $dst_history->protocol=$input['dstprotocol_'.$e];
          $dst_history->operative_system=$input['dstoperativesystem_'.$e];
          $dst_history->function=$input['dstfunction_'.$e];
          $dst_history->datetime=date('Y-m-d H:i:s');
          $dst_history->occurences_id=$dst->id;
          $dst_history->incident_handler_id=Auth::user()->incident_handler_id;
          $dst_history->save();

          $src_dst=new IncidentOccurence;
          $src_dst->source_id=$src->id;
          $src_dst->destiny_id=$dst->id;
          $src_dst->incidents_id=$incident->id;
          $src_dst->save();
        }

        foreach ($rules as $r) {
          //sid','rule','message','translate','rule_is','why
          $rule=new Rule;
          $rule->sid=$input['sid_'.$r];
          $rule->rule=$input['rule_'.$r];
          $rule->message=$input['message_'.$r];
          $rule->translate=$input['translate_'.$r];
          $rule->why=$input['why_'.$r];
          $rule->save();

          $incident_rule=new IncidentRule;
          $incident_rule->rules_id=$rule->id;
          $incident_rule->incidents_id=$incident->id;
          $incident_rule->save();


        }

      }
      else{
        //$this->layout = View::make("incidentHandler.create",array('handler' => $handler));
        return $this->layout = View::make("incident.form", array(
        'sensor_object'=>$sensor_object,
        'incident'=>$incident,
        'title'=>"Creación de Nuevo Incidente",
        'action'=>"IncidentController@create",
        'attack'=>$attack,
        'customer'=>$customer,
        'rule'=>$rule,
        'references'=>$references,
        'categories'=>$categories,
        'occurences_types'=>$occurences_types,
        'sensor'=>$sensor,
        ));
      }

    }

    public function update($id)
    {
      $input = Input::all();
      $incident=new Incident;
      $attack=Attack::lists('name', 'id');
      $categories=Category::lists('name', 'id');
      $customer=Customer::lists('company', 'id');
      $sensor=Sensor::lists('name', 'id');
      $rule=Rule::all();
      $references=new References;
      $occurences_types=OccurenceType::lists('name', 'id');

      $det_time=new Time;
      $occ_time=new Time;




      if ($input) {
        $keys=array_keys($input);
        //print_r($keys);
        $events=array();
        foreach ($keys as $k) {
          if (strpos($k,'srcip') !== false) {
              array_push($events,explode('_',$k)[1]);
          }
        }
        $rules=array();
        foreach ($keys as $k) {
          if (strpos($k,'sid') !== false) {
              array_push($rules,explode('_',$k)[1]);
          }
        }
        //validaciones
        $this->validateRequired($input);
        echo "\n<br>";
        foreach ($input['images'] as $im) {
          $this->validateImage($im);
          echo "\n<br>";
        }
        //validaciones

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
        $incident->incident_handler_id=Auth::user()->incident_handler_id;
        $incident->sensors_id=$input['sensor_id'];
        //$incident->incident_handler_id='1';
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


        foreach ($events as $e) {
          $src=new Occurence;
          $dst=new Occurence;

          $src_history=new OccurenceHistory;
          $dst_history=new OccurenceHistory;

          if($input['srcip_'.$e]=='')
            return "Ip no puede ir vacía";
          $src->ip=$input['srcip_'.$e];
          $src->occurrences_types_id=$input['srcoccurencestype_'.$e];
          $src->save();
          //'port','protocol','operative_system','function','datetime','occurences_id','incident_handler_id'
          $src_history->port=$input['srcport_'.$e];
          $src_history->protocol=$input['srcprotocol_'.$e];
          $src_history->operative_system=$input['srcoperativesystem_'.$e];
          $src_history->function=$input['srcfunction_'.$e];
          $src_history->datetime=date('Y-m-d H:i:s');
          $src_history->occurences_id=$src->id;
          $src_history->incident_handler_id=Auth::user()->incident_handler_id;
          $src_history->save();

          $dst->ip=$input['dstip_'.$e];
          $dst->occurrences_types_id=$input['dstoccurencestype_'.$e];
          $dst->save();
          //'port','protocol','operative_system','function','datetime','occurences_id','incident_handler_id'
          $dst_history->port=$input['dstport_'.$e];
          $dst_history->protocol=$input['dstprotocol_'.$e];
          $dst_history->operative_system=$input['dstoperativesystem_'.$e];
          $dst_history->function=$input['dstfunction_'.$e];
          $dst_history->datetime=date('Y-m-d H:i:s');
          $dst_history->occurences_id=$dst->id;
          $dst_history->incident_handler_id=Auth::user()->incident_handler_id;
          $dst_history->save();

          $src_dst=new IncidentOccurence;
          $src_dst->source_id=$src->id;
          $src_dst->destiny_id=$dst->id;
          $src_dst->incidents_id=$incident->id;
          $src_dst->save();
        }

        foreach ($rules as $r) {
          //sid','rule','message','translate','rule_is','why
          $rule=new Rule;
          $rule->sid=$input['sid_'.$r];
          $rule->rule=$input['rule_'.$r];
          $rule->message=$input['message_'.$r];
          $rule->translate=$input['translate_'.$r];
          $rule->why=$input['why_'.$r];
          $rule->save();

          $incident_rule=new IncidentRule;
          $incident_rule->rules_id=$rule->id;
          $incident_rule->incidents_id=$incident->id;
          $incident_rule->save();


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
        'sensor'=>$sensor,
        ));
      }

    }


}


 ?>
