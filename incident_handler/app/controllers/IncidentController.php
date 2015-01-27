<?php

class IncidentController extends Controller {
protected $layout = 'layouts.master';
    /**
     * Muestra el perfil de un usuario dado.
     */
     //evil function
    public function change_status()

    {
      return View::make('/');
    }


    public function edit($id)
    {
      $incident = Incident::find($id);
      return View::make('approved.approved')->with('incident', $incident);
    }

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
      //    'title' => 'required | regex:/^[A-Za-záéíóúÁÉÍÓÚ\_\,\;\!\?\"\:\-\(\)\#\=\.]+$/',
      //    'det_date' => 'required | regex:/^[0-9]{2}\-[0-9]{2}\-[0-9]{4}$/',
      //    'det_time' => 'required | regex:/^[0-9]{2}\s[0-9]{2}\s[AM|PM]$/',
      //    'occ_date' => 'required | regex:/^[0-9]{2}\-[0-9]{2}\-[0-9]{4}$/',
      //    'occ_time' => 'required | regex:/^[0-9]{2}\s[0-9]{2}\s[AM|PM]$/',
      //    'risk' => 'required | regex:/^[0-9]{2}$/',
      //    'criticity' => 'required | regex:/^[0-9]{2}$/',
      //    'impact' => 'required | regex:/^[0-9]{2}$/',
      //    'attack_id' => 'required | regex:/^[0-9]{5}$/',
      //    'category_id' => 'required | regex:/^[0-9]{5}$/',
      //    'customer_id' => 'required | regex:/^[0-9]{5}$/',
          'description' => 'required',
      //    'sensor_id' => 'required | regex:/^[0-9]{5}$/',
          'conclution' => 'required',
          'references' => 'required',
          'recomendations' => 'required'
      );
      $validator = Validator::make($input, $rules);
      if ($validator->fails())
      {
          echo "1";
      } else {
          echo "0";
      }
    }

    public function updateStatus(){
      $input = Input::all();
      $id = $input['id'];
      $status = $input['status'];

      if ( $id && $status) {
        $u = new Otrs\User();
        $ticketOtrs = new Otrs\Ticket();
        $ticketIM = new Ticket;

        $incident=Incident::find($id);
        $incident->incidents_status_id=$status;
        $incident->save();

        $det_time=Time::where('time_types_id','=','1')->where('incidents_id','=',$id)->first();
        $occ_time=Time::where('time_types_id','=','2')->where('incidents_id','=',$id)->first();
        $listed=array();
        $black_preview=IncidentOccurence::where("incidents_id","=",$id)->get ();
        $location=array();
        foreach ($black_preview as $b) {
          if ($b->src->blacklist) {
            array_push($listed,$b->src);
            $loc=DB::table('occurences_history')->select(DB::raw('max(datetime) as hist, location'))->where('occurences_id',"=",$b->src->id)->groupBy('location')->first();
            array_push($location,$loc);
            //print_r($loc);
            //echo "<br>";
          }
          if ($b->dst->blacklist) {
            array_push($listed,$b->dst);
            $loc=DB::table('occurences_history')->select(DB::raw('max(datetime) as hist, location'))->where('occurences_id',"=",$b->dst->id)->groupBy('location')->first();
            array_push($location,$loc);
            //print_r($loc);
            //echo "<br>";
          }
        }

       $htmlReport= $this->layout = View::make('incident.show', array(
         'det_time'=>$det_time,
         'occ_time'=>$occ_time,
         'incident'=>$incident,
         'listed'=>$listed,
         'location'=>$location
      ))->render();

        //print_r($ticketOtrs->getPriorities());
        $ticket_info = $ticketOtrs->createTicket($incident->title, 1, $incident->customer->otrs_userID,$htmlReport);
        $ticketIM->otrs_ticket_id = $ticket_info['TicketID'];
        $ticketIM->otrs_ticket_number = $ticket_info['TicketNumber'];
        $ticketIM->incident_handler_id = Auth::user()->id;
        $ticketIM->save();


        return Redirect::to('incident/view/'.$incident->id);
      }
    }

    public function validateSingle($input){
      $rules=array($input=>'required');
      $validator = Validator::make($input, $rules);
      if ($validator->fails())
      {
          echo "1";
      } else {
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
          if (strpos($k,'sid_') !== false) {
              array_push($rules,explode('_',$k)[1]);
          }
        }


        $incident->risk=$input['risk'];
        $incident->criticity=$input['criticity'];
        $incident->impact=$input['impact'];
        $incident->categories_id=$input['category_id'];
        $incident->attacks_id=$input['attack_id'];
        $incident->customers_id=$input['customers_id'];
        $incident->title=$input['title'];
        $incident->incidents_status_id=1;
        $incident->description=$input['description'];
        $incident->conclution=$input['conclution'];
        $incident->recomendation=$input['recomendation'];
        $incident->incident_handler_id=Auth::user()->incident_handler_id;
        $incident->sensors_id=$input['sensor_id'];
        $incident->stream=$input['stream'];
        //$incident->incident_handler_id='1';
        $incident->save();

        /*foreach ($input['images'] as $i) {
          if (1) {
            $im=new Image;
            $im->source=Auth::user()->incident_handler_id;
            $im->file=$i;
            $im->name=date("Ymd_his")."_".$incident->id."_".$incident->title;
            $im->incidents_id=$incident->id;
            $im->save();
          }
        }*/
        $history=new IncidentHistory;
        $history->datetime=date('Y-m-d H:i:s');
        $history->description="Se creó incidente";
        $history->incidents_status_id=1;
        $history->incident_handler_id=Auth::user()->incident_handler_id;
        $history->incidents_id=$incident->id;
        $history->save();

        $det_time->datetime=$input['det_date'].' '.date("H:i:s",strtotime($input['det_time']));
        $det_time->zone="UTC/GMT -6 horas";
        $occ_time->datetime=$input['occ_date'].' '.date("H:i:s",strtotime($input['occ_time']));
        $occ_time->zone="UTC/GMT -6 horas";
        $det_time->time_types_id=1;
        $occ_time->time_types_id=2;
        $det_time->incidents_id=$incident->id;
        $occ_time->incidents_id=$incident->id;
        $det_time->save();
        $occ_time->save();

        $references->incidents_id=$incident->id;
        $references->link=$input['references'];
        $references->save();
        foreach ($events as $e) {
          $dst=new Occurence;
          $src=new Occurence;


          if (Occurence::where('ip','=',$input['srcip_'.$e])->first()) {
            $src=Occurence::where('ip','=',$input['srcip_'.$e])->first();
          }
          if (Occurence::where('ip','=',$input['dstip_'.$e])->first()) {
            $dst=Occurence::where('ip','=',$input['dstip_'.$e])->first();
          }
          $src->blacklist=$input['srcblacklist_'.$e];
          $dst->blacklist=$input['dstblacklist_'.$e];
          $src_history=new OccurenceHistory;
          $dst_history=new OccurenceHistory;



          if($input['srcip_'.$e]=='')
            return "Ip no puede ir vacía";
          if($input['dstip_'.$e]=='')
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
          $src_history->location=$input['srclocation_'.$e];
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
          $dst_history->location=$input['dstlocation_'.$e];
          $dst_history->incident_handler_id=Auth::user()->incident_handler_id;
          $dst_history->save();

          $src_dst=new IncidentOccurence;
          $src_dst->source_id=$src->id;
          $src_dst->destiny_id=$dst->id;
          $src_dst->incidents_id=$incident->id;
          $src_dst->save();
        }

        foreach ($rules as $r) {
          $rule=new Rule;
          //sid','rule','message','translate','rule_is','why
          if (Rule::where('sid','=',$input['sid_'.$r])->first()) {
            $rule=Rule::where('sid','=',$input['sid_'.$r])->first();
          }else{
            $rule=new Rule;

          }

          $rule->sid=$input['sid_'.$r];
          $rule->rule=$input['rule_'.$r];
          $rule->rule_is=$input['ruleis_'.$r];
          $rule->message=$input['message_'.$r];
          $rule->translate=$input['translate_'.$r];
          $rule->why=$input['why_'.$r];
          $rule->save();

          $incident_rule=new IncidentRule;
          $incident_rule->rules_id=$rule->id;
          $incident_rule->incidents_id=$incident->id;
          $incident_rule->save();
        }

        return Redirect::to('incident/view/'.$incident->id);
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

    public function getUpdate($id)
    {

      $incident=Incident::find($id);
      $attack=Attack::lists('name', 'id');
      $categories=Category::lists('name', 'id');
      $customer=Customer::lists('company', 'id');
      $sensor=Sensor::lists('name', 'id');
      $rule=Rule::all();
      $incident_rule=$incident->incidentRule;
      $references=$incident->reference;
      $occurences_types=OccurenceType::lists('name', 'id');
      $incident_occurence=$incident->incidentOccurence;
      $det_time=Time::where('time_types_id','=','1')->where('incidents_id','=',$incident->id)->first();
      $occ_time=Time::where('time_types_id','=','2')->where('incidents_id','=',$incident->id)->first();


        //$this->layout = View::make("incidentHandler.create",array('handler' => $handler));
        return $this->layout = View::make("incident.form", array(
        'incident'=>$incident,
        'incident_rule'=>$incident_rule,
        'incident_occurence'=>$incident_occurence,
        'title'=>"Edición de Incidente",
        'action'=>"IncidentController@postUpdate",
        'attack'=>$attack,
        'customer'=>$customer,
        'rule'=>$rule,
        'references'=>$references,
        'categories'=>$categories,
        'occurences_types'=>$occurences_types,
        'sensor'=>$sensor,
        'det_time'=>$det_time,
        'occ_time'=>$occ_time,
        'update'=>'1',
      ));



    }
    public function postUpdate()
    {

      $input = Input::all();

      //$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      $id=$input['id'];

      $sensor_object= new Sensor;
      $input = Input::all();
      $incident=Incident::find($id);
      $det_time=Time::where('time_types_id','=','1')->where('incidents_id','=',$incident->id)->first();
      $occ_time=Time::where('time_types_id','=','2')->where('incidents_id','=',$incident->id)->first();

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
                  if (strpos($k,'sid_') !== false) {
                      array_push($rules,explode('_',$k)[1]);
                  }
                }


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
                $incident->sensors_id=$input['sensor_id'];
                $incident->stream=$input['stream'];
                $reference=$incident->reference;

                $reference->link=$input['references'];
                $reference->save();
                //$incident->incident_handler_id='1';
                $incident->save();

                /*foreach ($input['images'] as $i) {
                  if (1) {
                    $im=new Image;
                    $im->source=Auth::user()->incident_handler_id;
                    $im->file=$i;
                    $im->name=date("Ymd_his")."_".$incident->id."_".$incident->title;
                    $im->incidents_id=$incident->id;
                    $im->save();
                  }
                }*/
                $history=new IncidentHistory;
                $history->datetime=date('Y-m-d H:i:s');
                $history->description="Incidente Editado";
                $history->incidents_status_id=1;
                $history->incident_handler_id=Auth::user()->incident_handler_id;
                $history->incidents_id=$incident->id;
                $history->save();

                $det_time->datetime=$input['det_date'].' '.date("H:i:s",strtotime($input['det_time']));
                $det_time->zone="UTC/GMT -6 horas";
                $occ_time->datetime=$input['occ_date'].' '.date("H:i:s",strtotime($input['occ_time']));
                $occ_time->zone="UTC/GMT -6 horas";
                $det_time->time_types_id=1;
                $occ_time->time_types_id=2;
                $det_time->incidents_id=$incident->id;
                $occ_time->incidents_id=$incident->id;
                $det_time->save();
                $occ_time->save();

                //proceso de borrado incident occurrence|
                $register=$incident->incidentOccurence;
                foreach ($register as $r) {
                  $r->delete();
                }
                ////////////////////////////////////////|
                //proceso de borrado incident Rule      |
                $register=$incident->incidentRule;
                foreach ($register as $r) {
                  $r->delete();
                }
                ////////////////////////////////////////|

                foreach ($events as $e) {

                  $dst=new Occurence;
                  $src=new Occurence;

                  if (Occurence::where('ip','=',$input['srcip_'.$e])->first()) {
                    $src=Occurence::where('ip','=',$input['srcip_'.$e])->first();
                  }
                  if (Occurence::where('ip','=',$input['dstip_'.$e])->first()) {
                    $dst=Occurence::where('ip','=',$input['dstip_'.$e])->first();
                  }

                  $src->blacklist=$input['srcblacklist_'.$e];
                  $dst->blacklist=$input['dstblacklist_'.$e];
                  if($input['srcip_'.$e]=='')
                    return "Ip no puede ir vacía";
                  if($input['dstip_'.$e]=='')
                    return "Ip no puede ir vacía";
                  $src->ip=$input['srcip_'.$e];
                  $src->occurrences_types_id=$input['srcoccurencestype_'.$e];
                  $src->save();
                  $src_history=new OccurenceHistory;
                  //'port','protocol','operative_system','function','datetime','occurences_id','incident_handler_id'

                  $src_history->port=$input['srcport_'.$e];
                  $src_history->protocol=$input['srcprotocol_'.$e];
                  $src_history->operative_system=$input['srcoperativesystem_'.$e];
                  $src_history->function=$input['srcfunction_'.$e];
                  $src_history->datetime=date('Y-m-d H:i:s');
                  $src_history->occurences_id=$src->id;
                  $src_history->location=$input['srclocation_'.$e];
                  $src_history->incident_handler_id=Auth::user()->incident_handler_id;
                  $src_history->save();


                  $dst->ip=$input['dstip_'.$e];
                  $dst->occurrences_types_id=$input['dstoccurencestype_'.$e];
                  $dst->save();
                  $dst_history=new OccurenceHistory;
                  //'port','protocol','operative_system','function','datetime','occurences_id','incident_handler_id'
                  $dst_history->port=$input['dstport_'.$e];
                  $dst_history->protocol=$input['dstprotocol_'.$e];
                  $dst_history->operative_system=$input['dstoperativesystem_'.$e];
                  $dst_history->function=$input['dstfunction_'.$e];
                  $dst_history->datetime=date('Y-m-d H:i:s');
                  $dst_history->occurences_id=$dst->id;
                  $dst_history->location=$input['dstlocation_'.$e];
                  $dst_history->incident_handler_id=Auth::user()->incident_handler_id;
                  $dst_history->save();

                  $src_dst=new IncidentOccurence;
                  $src_dst->source_id=$src->id;
                  $src_dst->destiny_id=$dst->id;
                  $src_dst->incidents_id=$incident->id;
                  $src_dst->save();
                }

                foreach ($rules as $r) {
                  $rule=new Rule;
                  //sid','rule','message','translate','rule_is','why
                  if (Rule::where('sid','=',$input['sid_'.$r])->first()) {
                    $rule=Rule::where('sid','=',$input['sid_'.$r])->first();
                  }else{
                    $rule=new Rule;

                  }

                  $rule->sid=$input['sid_'.$r];
                  $rule->rule=$input['rule_'.$r];
                  $rule->rule_is=$input['ruleis_'.$r];
                  $rule->message=$input['message_'.$r];
                  $rule->translate=$input['translate_'.$r];
                  $rule->why=$input['why_'.$r];
                  $rule->save();

                  $incident_rule=new IncidentRule;
                  $incident_rule->rules_id=$rule->id;
                  $incident_rule->incidents_id=$incident->id;
                  $incident_rule->save();
                }

                return Redirect::to('incident/view/'.$incident->id);



      }


    }

  public function view($id)
  {
    //$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $incident=Incident::find($id);

    $det_time=Time::where('time_types_id','=','1')->where('incidents_id','=',$id)->first();
    $occ_time=Time::where('time_types_id','=','2')->where('incidents_id','=',$id)->first();
    $listed=array();
    $black_preview=IncidentOccurence::where("incidents_id","=",$id)->get ();
    $location=array();
    foreach ($black_preview as $b) {
      if ($b->src->blacklist) {
        array_push($listed,$b->src);
        $loc=DB::table('occurences_history')->select(DB::raw('max(datetime) as hist, location'))->where('occurences_id',"=",$b->src->id)->groupBy('location')->first();
        array_push($location,$loc);
        //print_r($loc);
        //echo "<br>";

      }
      if ($b->dst->blacklist) {
        array_push($listed,$b->dst);
        $loc=DB::table('occurences_history')->select(DB::raw('max(datetime) as hist, location'))->where('occurences_id',"=",$b->dst->id)->groupBy('location')->first();
        array_push($location,$loc);
        //print_r($loc);
        //echo "<br>";
      }
    }
    return $this->layout = View::make('incident.view', array(
      'det_time'=>$det_time,
      'occ_time'=>$occ_time,
      'incident'=>$incident,
      'listed'=>$listed,
      'location'=>$location
      ));

  }
  public function pdf($id)
  {
    //$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $incident=Incident::find($id);

    $det_time=Time::where('time_types_id','=','1')->where('incidents_id','=',$id)->first();
    $occ_time=Time::where('time_types_id','=','2')->where('incidents_id','=',$id)->first();
    $listed=array();
    $black_preview=IncidentOccurence::where("incidents_id","=",$id)->get ();
    $location=array();
    foreach ($black_preview as $b) {
      if ($b->src->blacklist) {
        array_push($listed,$b->src);
        $loc=DB::table('occurences_history')->select(DB::raw('max(datetime) as hist, location'))->where('occurences_id',"=",$b->src->id)->groupBy('location')->first();
        array_push($location,$loc);
        //print_r($loc);
        //echo "<br>";
      }
      if ($b->dst->blacklist) {
        array_push($listed,$b->dst);
        $loc=DB::table('occurences_history')->select(DB::raw('max(datetime) as hist, location'))->where('occurences_id',"=",$b->dst->id)->groupBy('location')->first();
        array_push($location,$loc);
        //print_r($loc);
        //echo "<br>";
      }
    }


    $html= $this->layout = View::make('incident.show', array(
      'det_time'=>$det_time,
      'occ_time'=>$occ_time,
      'incident'=>$incident,
      'listed'=>$listed,
      'location'=>$location

      ));

    $pdf = App::make('dompdf');

    $pdf->loadHTML($html,1);
    return $pdf->stream();

  }
  public function index(){

    if (Auth::user()->type->name == 'admin')
      $incident=Incident::all();
    else
      $incident = Incident::where('incident_handler_id','=',Auth::user()->id)->get();

    return $this->layout = View::make('incident.index', array(
    'incident'=>$incident,
    ));
  }
}


 ?>
