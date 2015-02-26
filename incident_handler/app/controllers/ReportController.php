<?php

class ReportController extends Controller{

    public function index() {
        return View::make('report.incident');
    }

    public  function view($type){
        return View::make('report.incident', array(
            'type' => $type
        ));
    }

    public function create(){
        $input = Input::all();
        $start_date = $input['start_date']. ' ' . '00:00:00';
        $end_date = $input['end_date']. ' ' . '23:59:59';
        $time_type = $input['time_type'];
        $customer_id = $input['customer'];

        if (isset($input['type'])) {
            $type = $input['type'];
            $value = $input['type_value'];
            return $this->byType($start_date, $end_date, $time_type,$customer_id,$type,$value);
        } else {
            return $this->defaultReport($start_date,$end_date,$time_type,$customer_id);
        }
    }

    private function defaultReport($start_date, $end_date, $time_type,$customer_id){

        $headers = array(
            "Content-type" => "application/vnd.ms-word",
            "Content-Disposition"=>"attachment;Filename=Reporte_incidentes.doc"
        );

        $incidents = Incident::where('customers_id','=',$customer_id)
            ->join('time',"incidents.id",'=','time.incidents_id')
            ->where('time_types_id','=',$time_type)
            ->whereBetween('time.datetime',array(new DateTime($start_date), new DateTime($end_date)))
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
                $field = "incident_handler_id";
                break;

            case 'category':
                $field = "category_id";
                break;

            case 'severity':
                $field = "criticity";
                break;

            case 'status':
                $field = "incidents_status_id";
                break;
        }

        $incidents = Incident::where('customers_id','=',$customer_id)
            ->where($field,'=',$value)
            ->join('time',"incidents.id",'=','time.incidents_id')
            ->where('time_types_id','=',$time_type)
            ->whereBetween('time.datetime',array(new DateTime($start_date), new DateTime($end_date)))
            ->get();
        Log::info(DB::getQueryLog());
        Log::info("----------------------------------------------");

        $htmlReport = $this->renderDocReport($incidents);
        return Response::make($htmlReport,200,$headers);
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