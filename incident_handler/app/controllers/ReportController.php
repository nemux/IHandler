<?php

class ReportController extends Controller{

    public function index() {
        return View::make('report.incident');
    }

    public  function view($type){

        if ($type == 'ip')
            return View::make('report.ip');

        return View::make('report.incident', array(
            'type' => $type
        ));
    }

    public function create(){
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

    private function byType($start_date, $end_date, $time_or_ip_type,$customer_id,$type,$value){
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
            ->where('T.time_types_id', '=', $time_or_ip_type)
            ->whereNull('I.deleted_at')
            ->whereBetween('T.datetime', array(new DateTime($start_date), new DateTime($end_date)))
            ->get();

        $htmlReport = $this->renderDocReport($incidents);
        return Response::make($htmlReport,200,$headers);
    }

    public function byTypeIP($start_date, $end_date, $time_type,$customer_id,$ip_type,$value)
    {
        $headers = array(
            "Content-type" => "application/vnd.ms-word",
            "Content-Disposition" => "attachment;Filename=Reporte_incidentes.doc"
        );

        if ($customer_id == 0) {
            $ips = explode(',', $value);
            $incidents=DB::select(DB::raw(" select
                                              i.id
                                            from
                                              incidents as i,
                                              occurrences as o,
                                              incidents_occurences as io
                                            where
                                              o.ip='"+$value+"'
                                            and
                                              io.incidents_id=i.id
                                            and
                                              io."+$ip_type+"=o.id
                                            group by i.id"));
            /*$incidents = DB::table('incidents AS I')->distinct()->select('I.id')
                ->join('incidents_occurences AS io', 'I.id', '=', 'io.incidents_id')
                ->join('occurrences AS o', $ip_type == 1 ? 'io.source_id' : 'io.destiny_id', '=', 'o.id')
                ->join('time AS T', "I.id", '=', 'T.incidents_id')
                ->whereIn('o.ip', $ips)
                ->whereNull('I.deleted_at')
                ->where('T.time_types_id', '=', $time_type)
                ->whereBetween('T.datetime', array(new DateTime($start_date), new DateTime($end_date)))
                ->get();*/
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

    private function renderDocReport($incidents, $introduction=null){

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

        return $htmlReport = $this->layout = View::make('report.doc', array(
            'incidents' => $incidents,
            'report_info'=>$report_info,
            'body' => $introduction
        ))->render();
    }
}
?>
