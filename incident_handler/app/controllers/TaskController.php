<?php

class TaskController extends Controller
{

    public function closeTickets() {

        //Get all customers
        $customers = Customers::all();

        foreach ($customers as $customer) {
            //Send Email notifications according to the criticity time.

            foreach (array('BAJA', 'MEDIA', 'ALTA') as $criticity) {
                $time_interval = '';
                switch ($criticity) {
                    case 'BAJA':
                        $time_interval = $customer->sla->slow;
                        break;

                    case 'MEDIA':
                        break;

                    case 'ALTA':
                        break;
                }
                $results = DB::select(DB::raw("SELECT t.incidents_id FROM tickets t JOIN incidents i ON t.incidents_id = i.id WHERE t.updated_at < NOW() - INTERVAL :time_interval AND i.customers_id = :cusromer_id AND i.criticity= :criticity AND t.deleted_at IS NULL ORDER BY t.incidents_id ASC"), array(
                    'time_interval' => $time_interval,
                    'customers_id' => $customer->id,
                    'criticity' => $criticity
                ));
            }

        }
    }

    public function sendReminder() {
        //Get all customers
        $customers = Customer::all();

        foreach (Customer::with('sla')->get() as $customer) {
            //Send Email notifications according to the criticity time.
            foreach (array('BAJA', 'MEDIA', 'ALTA') as $criticity) {
                $time_interval = '';
                switch ($criticity) {
                    case 'BAJA':
                        $time_interval = $customer;
                        Log::info("-----------------------------");
                        Log::info($customer);
                        break;

                    case 'MEDIA':
                        $time_interval = $customer->sla;
                        Log::info("-----------------------------");
                        Log::info($customer->sla);
                        break;

                    case 'ALTA':
                        $time_interval = $customer->sla;
                        Log::info("-----------------------------");
                        Log::info($customer->sla);
                        break;
                }
                $incidents = DB::select(DB::raw("SELECT t.incidents_id
                                                 FROM tickets t JOIN incidents i ON t.incidents_id = i.id
                                                 WHERE t.updated_at < NOW() - INTERVAL :time_interval
                                                 AND i.customers_id = :customers_id
                                                 AND i.criticity= :criticity
                                                 AND (incidents_status_id = 2 OR incidents_status_id = 3)
                                                 AND t.deleted_at IS NULL
                                                 ORDER BY t.incidents_id ASC"), array(
                    'time_interval' => $time_interval,
                    'customers_id' => $customer->id,
                    'criticity' => $criticity
                ));

                foreach($incidents as $i){
                    $incident = Incidents::find($i);
                    Log::info('SE CERRARA Ticket ->' . $incident->ticket->internal_number . ' en ' . $time_interval . ' horas.' );
                }
            }
        }
    }

    private function sendEmail() {
        Mail::send('incident.show',array(
            'det_time'=>$det_time,
            'occ_time'=>$occ_time,
            'incident'=>$incident,
            'listed'=>$listed,
            'location'=>$location,
            'recomendations' => $recomendations,
            'body' => $body
        ),
            function ($message) use ($incident, $subject){
                $log = new Log\Logger();
                $temp_mails = str_replace(array(",",";"), ",", $incident->customer->mail);
                $mails = explode(",", $temp_mails);

                $message->to($mails)->cc('soc@globalcybersec.com')->subject($subject);
                //$message->to($mails)->subject($subject);
                $log->info(Auth::user()->id,Auth::user()->username,'Se envió Email a '. $incident->customer->mail . ' referente al incidente: '. $incident->id);
            });

    }


}