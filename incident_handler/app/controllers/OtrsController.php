<?php

class OtrsController extends BaseController
{

    public function import()
    {
        return $this->layout = View::make("otrs.import", array(
            'actions' => array('OtrsController@importCustomers' => 'Importar Clientes'
            ),
            'title' => "Importar información desde OTRS",
            'total' => 0
        ));
    }

    public function importCustomers()
    {
        if (Auth::user()->type->name == 'admin') {
            //Import all OTRS Customers
            $oc = new Otrs\Customer();
            $customers = $oc->getAll();
            $log = new Log\Logger();

            $total_inserted = 0;
            if ($customers["response_status"] == 0) {
                foreach ($customers as $k => $v) {

                    $cu = $oc->getInfo($v['UserName']);
                    if (!isset($cu['error_code'])) {

                        $exists = Customer::where('otrs_userID', '=', $cu['UserID'])->count();

                        if ($exists == 0) {
                            $customer = new Customer();
                            $sla = new CustomerSla();

                            $customer->name = $cu['UserFirstname'] . " " . $cu['UserLastname'];
                            $customer->company = $cu['UserTitle'];
                            $customer->mail = $cu['UserEmail'];
                            $customer->phone = $cu['UserPhone'];
                            $customer->otrs_userID = $cu['UserID'];
                            $customer->otrs_userlogin = $cu['UserLogin'];
                            $customer->otrs_usercustomerID = $cu['UserCustomerID'];
                            $customer->otrs_validID = $cu['ValidID'];
                            $customer->save();
                            $sla->customers_id = $customer->id;
                            $sla->save();
                            $total_inserted++;
                        }
                    }
                }
                $log->info(Auth::user()->id, Auth::user()->username, $total_inserted . " Clientes Importados de OTRS.");
                return $this->layout = View::make("otrs.result", array(
                    'result' => 'Clientes insertados: ' . $total_inserted,
                ));
            }
        }
    }


    protected function sendTicket($key, $id)
    {

        $system_key = Config::get('api.key');
        $user_key = $key;

        if ($system_key == $user_key) {
            $incident_id = $id;
            $u = new Otrs\User();
            $ticketOtrs = new Otrs\Ticket();
            $incident = Incident::find($incident_id);
            $ticketIM = Ticket::find($incident->ticket->id);

            if ($ticketIM->otrs_ticket_id == "") {
                $htmlReport = $this->renderReport($incident);
                $ticket_info = $ticketOtrs->create($incident->title, $incident->risk, $incident->customer, $htmlReport);
                $ticketIM->otrs_ticket_id = $ticket_info['TicketID'];
                $ticketIM->otrs_ticket_number = $ticket_info['TicketNumber'];
                $ticketIM->save();
                return 'Incident ID->' . $ticketIM->incidents_id . '\nTicket IM->' . $ticketIM->internal_number . '\nTicket OTRS->' . $ticketIM->otrs_ticket_number;
            } else {
                return "Ya se ha generado el ticket en OTRS anteriormente, el numero es->" . $ticketIM->otrs_ticket_number;
            }
        } else
            return array('error' => 'Error de autenticacion');
    }

    public function test($id)
    {

        $user = new Otrs\User;
        $o = new Otrs\Customer();
        print_r($o->getAll());

        //$userInfo = $user->getInfo('gcs_im');
        /*
        $o = new Otrs\Customer();
        $u = new Otrs\User();
        $ticket = new Otrs\Ticket();
        $a = new Otrs\Article();

          $ticket_info = $ticket->createTicket("Ticket desde Laravel", 3, "ldeleon", "Probando la creacion de tickets desde Laravel, intento 2");
      foreach($ticket_info as $k=>$v){
          print("[");
          print($k);
          print("]=>");
          print($v);
          print("<br/>");

      //print_r($o->getAll());
      /*
      foreach ($u->getAll() as $k=>$v){
        print("[");
        print($k);
        print("]=>");
        foreach($v as $k2 => $v2){
          print("[");
          print($k2);
          print("]=>");
          print($v2);
          print("<br/>");
        }
        //print_r($v);
        print("<br/>");
      }
      */
        /*
        print_r($u->getUserInfo($name));

        foreach($u->getUserInfo($name) as $k=>$v){
           print("[");
            print($k);
            print("]=>");
            print($v);
            print("<br/>");
        }
        */


        /*
        $ticket_info = $t->createTicket("Ticket desde Laravel", 3, "ldeleon", "Probando la creacion de tickets desde Laravel, intento 2");
        foreach($ticket_info as $k=>$v){
            print("[");
            print($k);
            print("]=>");
            print($v);
            print("<br/>");
        }
        */

        //print_r($a->createArticle(21, 3, "juas@juas.com", "Poniendo otro articulo juas, juas", "nemux", "A ver si jala esta madre y no se truena"));

        //$nombre = $o->getCustomerById($name);
        //print_r($nombre);
        //$d = $o->getCustomerInfo($name);
        //print_r($d);
        //return array("function"=>'get/otrs');

        //$ticket = new Otrs\Ticket();

        //print_r($ticket->getInfo($id));

    }

    private function renderReport($incident, $introduction = null)
    {
        $det_time = Time::where('time_types_id', '=', '1')->where('incidents_id', '=', $incident->id)->first();
        $occ_time = Time::where('time_types_id', '=', '2')->where('incidents_id', '=', $incident->id)->first();
        $listed = array();
        $black_preview = IncidentOccurence::where("incidents_id", "=", $incident->id)->get();
        $location = array();
        foreach ($black_preview as $b) {
            if ($b->src->blacklist) {
                array_push($listed, $b->src);
                $loc = DB::table('occurences_history')->select(DB::raw('max(datetime) as hist, location'))->where('occurences_id', "=", $b->src->id)->groupBy('location')->orderBy('hist', 'desc')->first();
                array_push($location, $loc);
                //print_r($loc);
                //echo "<br>";
            }
            if ($b->dst->blacklist) {
                array_push($listed, $b->dst);
                $loc = DB::table('occurences_history')->select(DB::raw('max(datetime) as hist, location'))->where('occurences_id', "=", $b->dst->id)->groupBy('location')->orderBy('hist', 'desc')->first();
                array_push($location, $loc);
                //print_r($loc);
                //echo "<br>";
            }
        }

        $recomendations = Recomendation::where('incidents_id', '=', $incident->id)->get();

        return $htmlReport = $this->layout = View::make('incident.show', array(
            'det_time' => $det_time,
            'occ_time' => $occ_time,
            'incident' => $incident,
            'listed' => $listed,
            'location' => $location,
            'recomendations' => $recomendations,
            'body' => $introduction
        ))->render();
    }
}
