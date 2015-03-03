<?php

class ReportController extends Controller{

    public function index() {
        return View::make('report.incident');
    }

    public  function view($type){

        if ($type == 'ip')
            return View::make('report.ip');

        if ($type == 'csv')
            return View::make('report.csv');

        return View::make('report.incident', array(
            'type' => $type
        ));
    }

    public function create_doc(){
        $input = Input::all();
        $start_date = $input['start_date']. ' ' . '00:00:00';
        $end_date = $input['end_date']. ' ' . '23:59:59';
        $customer_id = $input['customer'];
        $time_type = $input['time_type'];

        if (isset($input['type'])) {
            $type = $input['type'];
            $value = $input['type_value'];
        }

        $userData = array(
            'start_date' => Input::get('start_date'),
            'end_date' => Input::get('end_date')
        );

        $rules = array(
            'start_date'=>'required|date_format:m/d/Y',
            'end_date'=>'required|date_format:m/d/Y'
        );

        $validator = Validator::make($userData, $rules);

        if ($validator->passes()) {
            if (isset($input['type'])) {
                if ($input['type'] == 'ip') {
                    $ip_type = $input['ip_type'];
                    return $this->byTypeIP($start_date, $end_date, $time_type, $customer_id, $ip_type, $value);
                } else
                    return $this->byType($start_date, $end_date, $time_type, $customer_id, $type, $value);
            } else {
                return $this->defaultReport($start_date, $end_date, $time_type, $customer_id);
            }
            } else {
                if (isset($input['type']))
                    return Redirect::to('/report/' . $type);
                else
                    return Redirect::to('/report');
            }
        }

    public function create_csv(){
        $input = Input::all();
        $start_date = $input['start_date']. ' ' . '00:00:00';
        $end_date = $input['end_date']. ' ' . '23:59:59';
        $customer_id = $input['customer'];
        $time_type = $input['time_type'];

        $userData = array(
            'start_date' => Input::get('start_date'),
            'end_date' => Input::get('end_date')
        );

        $rules = array(
            'start_date'=>'required|date_format:m/d/Y',
            'end_date'=>'required|date_format:m/d/Y'
        );

        $validator = Validator::make($userData, $rules);

        if ($validator->passes())
                    return $this->csvFile($start_date,$end_date,$time_type,$customer_id);
        else
            return Redirect::to('/report/csv');
    }

    private function defaultReport($start_date, $end_date, $time_type,$customer_id){

        $headers = array(
            "Content-type" => "application/vnd.ms-word",
            "Content-Disposition"=>"attachment;Filename=Reporte_incidentes.doc"
        );

        $incidents = DB::table('incidents AS I')->select('I.id')
            ->where('I.customers_id','=',$customer_id)
            ->join('time AS T',"I.id",'=','T.incidents_id')
            ->where('T.time_types_id','=',$time_type)
            ->whereBetween('T.datetime',array(new DateTime($start_date), new DateTime($end_date)))
            ->get();

        $htmlReport = $this->renderDocReport($incidents);
        return Response::make($htmlReport,200,$headers);
    }

    private function byType($start_date, $end_date, $time_type,$customer_id,$type,$value){
        $headers = array(
            "Content-type" => "application/vnd.ms-word",
            "Content-Disposition"=>"attachment;Filename=Reporte_incidentes.doc"
        );

        $field = "";
        switch($type){
            case 'handler':
                $field = "I.incident_handler_id";
                break;

            case 'category':
                $field = "I.category_id";
                break;

            case 'severity':
                $field = "I.criticity";
                break;

            case 'status':
                $field = "I.incidents_status_id";
                break;
        }

        $incidents = DB::table('incidents AS I')->distinct()->select('I.id')
            ->where('I.customers_id', '=', $customer_id)
            ->where($field, '=', $value)
            ->join('time AS T', "I.id", '=', 'T.incidents_id')
            ->where('T.time_types_id', '=', $time_type)
            ->whereNull('I.deleted_at')
            ->whereBetween('T.datetime', array(new DateTime($start_date), new DateTime($end_date)))
            ->get();

        $htmlReport = $this->renderDocReport($incidents);
        return Response::make($htmlReport,200,$headers);
    }

    private function byTypeIP($start_date, $end_date, $time_type,$customer_id,$ip_type,$value)
    {
        $headers = array(
            "Content-type" => "application/vnd.ms-word",
            "Content-Disposition" => "attachment;Filename=Reporte_incidentes.doc"
        );

        if ($customer_id == 0) {
            $ips = explode(',', $value);
            $incidents = DB::table('incidents AS I')->distinct()->select('I.id')
                ->join('incidents_occurences AS io', 'I.id', '=', 'io.incidents_id')
                ->join('occurrences AS o', $ip_type == 1 ? 'io.source_id' : 'io.destiny_id', '=', 'o.id')
                ->join('time AS T', "I.id", '=', 'T.incidents_id')
                ->whereIn('o.ip', $ips)
                ->whereNull('I.deleted_at')
                ->where('T.time_types_id', '=', $time_type)
                ->whereBetween('T.datetime', array(new DateTime($start_date), new DateTime($end_date)))
                ->get();
        } else {
            $ips = explode(',', $value);
            $incidents = DB::table('incidents AS I')->distinct()->select('I.id')
                ->join('incidents_occurences AS io', 'I.id', '=', 'io.incidents_id')
                ->join('time AS T', "I.id", '=', 'T.incidents_id')
                ->join('occurrences AS o', $ip_type == 1 ? 'io.source_id' : 'io.destiny_id', '=', 'o.id')
                ->whereIn('o.ip', $ips)
                ->whereNull('I.deleted_at')
                ->where('T.time_types_id', '=', $time_type)
                ->where('I.customers_id', '=', $customer_id)
                ->whereBetween('T.datetime', array(new DateTime($start_date), new DateTime($end_date)))
                ->get();
        }

        $htmlReport = $this->renderDocReport($incidents);
        return Response::make($htmlReport, 200, $headers);
    }

    private function csvFile($start_date,$end_date,$time_type,$customer_id){

        $incidents = $incidents = DB::table('incidents AS I')->select('I.id')
                                ->join('time AS Tim',"I.id",'=','Tim.incidents_id')
                                ->join('tickets as Tik','I.id','=','Tik.incidents_id')
                                ->where('I.customers_id','=',$customer_id)
                                ->where('Tim.time_types_id','=',$time_type)
                                ->whereBetween('Tim.datetime',array(new DateTime($start_date), new DateTime($end_date)))
                                ->get();

        $report_info = $this->getIncidentsInfo($incidents);

        // the csv file with the first row
        $output = implode(",", array('Titulo', 'Categoria',
                                     'Sensores','Ticket','Estatus',
                                     'Indicador_de_compromiso_inicial','Flujo_de_ataque', 'Fecha_de_deteccion',
                                     'Severidad','IP_de_origen','IP_de_destino',
                                     'Blacklist','Descripcion','Recomendacion',
                                     'Referencias','Anexos'));
        $output .= "\n";

        foreach ($incidents as  $i) {
            $incident = Incident::find($i->id);
            $tmp = 0;

            $title = "\"". $incident->title . "\"";

            //Puede haber varias categorias
            $categorias = "\"" . "[" . ($incident->category->id -1) . "|" . $incident->category->name . "|" . $incident->category->description . "]";
            foreach ($incident->extraCategory as $ec)
                $categorias .= "[" . ($ec->category->id -1) . "|" . $ec->category->name . "|" . $ec->category->description . "]";
            $categorias .= "\"";


            $sensor = "\"" . $incident->sensor->name;
            foreach ($incident->extraSensor as $es)
                $sensor .= "|" . $es->sensor->name;
            $sensor .= "\"";

            $ticket = "\"" . $incident->ticket->internal_number . "\"";
            $status = "\"" . $incident->status->name . "\"";

            $tmp = 0;
            $rules = "\"";
            foreach ($incident->incidentRule as $r) {
                if ($tmp > 0)
                    $rules .= "|";
                $r->rule->message;
                $tmp++;
            }
            $rules .= "\"";

            $flujo_ataque = "\"" . $incident->stream . "\"";
            $occurrence_datetime = "\"" . $report_info[$incident->id]['det_time']['datetime'] .",". $report_info[$incident->id]['det_time']['zone'] . "\"";
            $severidad = "\"" . $incident->criticity . "\"";

            $tmp = 0;
            $ip_origen = "\"";
            foreach ($incident->srcDst as $ip) {
                if ($ip->src->ip != "" && $ip->src->show != false) {
                    if ($tmp > 0)
                        $ip_origen .= "|";
                    $ip_origen .= $ip->src->ip;
                    $tmp++;
                }
            }
            $ip_origen .= "\"";

            $tmp = 0;
            $ip_destino = "\"";
            foreach ($incident->srcDst as $ip) {
                if ($ip->dst->ip!="" && $ip->dst->show != false) {
                    if ($tmp > 0)
                        $ip_destino .= "|";
                    $ip_destino .= $ip->dst->ip;
                    $tmp++;
                }
            }
            $ip_destino .= "\"";

            $blacklist = "\"";
            if (count($incident['listed']) > 0) {
                for ($i = 0; $i < count($incident['listed']); $i++){
                    $blacklist .= "[".$incident['listed'][$i] . "|";
                    $blacklist .= isset($incident['location'][$i]) ? $incident['location'][$i] : "";
                    $blacklist .= "]";
                }
            }
            $blacklist .= "\"";

            $descripcion = "\"" . $incident->description ."\n" .  $incident->conclution . "\"";
            $recomendacion= "\"" . $incident->recomendation . "\"";

            if (isset($incident->reference->link))
                $referencias = "\"" . $incident->reference->link . "\"";

            $anexos = "\"";
            foreach ($incident->annexes as $a )
                $anexos .= "[" . $a->title . "|" . $a->field . "|" . $a->content . "]";
            $anexos .= "\"";

            $output .= implode(",", array(
                $title, $categorias,
                $sensor, $ticket, $status,
                $rules,$flujo_ataque,$occurrence_datetime,
                $severidad, $ip_origen, $ip_destino,
                $blacklist, $descripcion, $recomendacion,
                $referencias,$anexos));
            $output .= "\n";
        }

        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="tweets.csv"',
        );

        // our response, this will be equivalent to your download() but
        // without using a local file
        return Response::make(rtrim($output, "\n"), 200, $headers);
    }

    private function getIncidentsInfo($incidents){
        $report_info = array();

        foreach ($incidents as $i){
            $incident['det_time'] = Time::where('time_types_id','=','1')->where('incidents_id','=',$i->id)->first();
            $incident['occ_time'] = Time::where('time_types_id','=','2')->where('incidents_id','=',$i->id)->first();
            $listed = array();
            $black_preview = IncidentOccurence::where("incidents_id","=",$i->id)->get();
            $location = array();
            foreach ($black_preview as $b) {
                if ($b->src->blacklist) {
                    array_push($listed,$b->src);
                    $loc=DB::table('occurences_history')->select(DB::raw('max(datetime) as hist, location'))->where('occurences_id',"=",$b->src->id)->groupBy('location')->first();
                    array_push($location,$loc);
                }
                if ($b->dst->blacklist) {
                    array_push($listed,$b->dst);
                    $loc=DB::table('occurences_history')->select(DB::raw('max(datetime) as hist, location'))->where('occurences_id',"=",$b->dst->id)->groupBy('location')->first();
                    array_push($location,$loc);
                }
            }
            $incident['listed'] = $listed;
            $incident['location'] = $location;
            $incident['recomendations'] = Recomendation::where('incidents_id','=',$i->id)->get();
            $report_info[$i->id] = $incident;
        }
        return $report_info;
    }

    private function renderDocReport($incidents, $introduction=null){

        $report_info = $this->getIncidentsInfo($incidents);

        return View::make('report.doc', array(
            'incidents' => $incidents,
            'report_info'=>$report_info,
            'body' => $introduction
        ))->render();
    }
}
?>