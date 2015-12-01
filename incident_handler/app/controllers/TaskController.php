<?php

class TaskController extends Controller
{

    public function closeTickets()
    {

        $system_key = Config::get('api.key');
        $user_key = Input::get('key');

        if ($system_key == $user_key) {
            $log = new Log\Logger();
            $cont = 0;
            foreach (Customer::with('sla')->get() as $customer) {
                //Send Email notifications according to the criticity time.
                foreach (array('BAJA', 'MEDIA', 'ALTA') as $criticity) {
                    $incidents = $this->getFinishedTickets($criticity, $customer, 'CLOSE');
                    foreach ($incidents['incidents'] as $i) {
                        $incident = Incident::find($i->incidents_id);
                        $body = 'Debido a la falta de una respuesta del incidente relacionado con este ticket, se ha cerrado automáticamente por el sistema.';
                        $subject = '[GCS-IM]-Recordatorio de cierre de Ticket ' . $incident->ticket->internal_number;
                        $images = Image::where('incidents_id', '=', $i->incidents_id)->get();
                        $this->sendEmail($incident, $subject, $body, $images);
                        $incident->incidents_status_id = 6;
                        $incident->save();
                        $log->info('0', 'Automatic_task', 'Cierre de ticket automático referente al incidente: ' . $incident->id);
                        $cont++;
                    }
                }
            }
            return array('total_closed' => $cont);
        } else
            return array('error' => "Error de autenticacion");
    }

    public function sendReminder()
    {

        $system_key = Config::get('api.key');
        $user_key = Input::get('key');

        if ($system_key == $user_key) {
            $log = new Log\Logger();
            $cont = 0;
            foreach (Customer::with('sla')->get() as $customer) {
                //Send Email notifications according to the criticity time.
                foreach (array('BAJA', 'MEDIA', 'ALTA') as $criticity) {
                    $incidents = $this->getFinishedTickets($criticity, $customer, 'REMINDER');
                    foreach ($incidents['incidents'] as $i) {
                        $incident = Incident::find($i->incidents_id);
                        $body = 'Le recordamos que si no recibimos respuesta sobre el incidente relacionado a este ticket, se cerrar&aacute;
                         autom&aacute;ticamente en ' . $incidents['hours'] . ' horas.';
                        //$body = 'Le recordamos que si no recibimos respuesta sobre el incidente relacionado a este ticket, se cerrar&aacute;
                        // autom&aacute;ticamente.';
                        $subject = '[GCS-IM]-Recordatorio de cierre de Ticket ' . $incident->ticket->internal_number;
                        $images = Image::where('incidents_id', '=', $incident->incidents_id)->get();
                        $this->sendEmail($incident, $subject, $body, $images);
                        $incident->ticket->reminder_sended = 1;
                        $incident->push();
                        $log->info('0', 'Automatic_task', 'Recordatorio de cierre de incidente: ' . $incident->id);
                        Log::info('Recordatorio de cierre de incidente-> ' . $incident->id);
                        $cont++;
                    }
                }
            }
            return array('total_sended' => $cont);
        } else
            return array('error' => "Error de autenticacion");
    }

    private function getFinishedTickets($criticity, $customer, $type)
    {
        $reminder_time = '';
        $close_time = '';
        switch ($criticity) {
            case 'BAJA':
                $reminder_time = $customer->sla->reminder_low;
                $close_time = $customer->sla->close_low;
                break;

            case 'MEDIA':
                $reminder_time = $customer->sla->reminder_medium;
                $close_time = $customer->sla->close_medium;
                break;

            case 'ALTA':
                $reminder_time = $customer->sla->reminder_high;
                $close_time = $customer->sla->close_high;
                break;
        }

        $query = "SELECT t.incidents_id
                  FROM tickets t JOIN incidents i ON t.incidents_id = i.id
                  WHERE t.created_at < NOW() - INTERVAL '";
        $query .= $type == 'CLOSE' ? $close_time : $reminder_time;
        $query .= " hours' AND i.customers_id = $customer->id
                   AND i.criticity= '$criticity'
                   AND t.reminder_sended = ";
        /*
        $query .= " 10 days' AND i.customers_id = $customer->id
                   AND i.criticity= '$criticity'
                   AND t.reminder_sended = ";
        */
        $query .= $type == 'CLOSE' ? 1 : 0;
        $query .= " AND (incidents_status_id = 2 OR incidents_status_id = 3)
                   AND t.deleted_at IS NULL
                   ORDER BY t.incidents_id ASC";

        $incidents = DB::select(DB::raw($query));
        return array('incidents' => $incidents, 'hours' => ($close_time - $reminder_time));
    }

    private function sendEmail($incident, $subject, $body = null, $images)
    {

        $title = 'Recordatorio de cierre de Ticket ' . $incident->ticket->internal_number;
        $subtitle = $incident->customer->company;

        Mail::send('task.reminder', array(
            'title' => $title,
            'subtitle' => $subtitle,
            'body' => $body,
        ),
            function ($message) use ($incident, $subject) {//, $images) {
                $log = new Log\Logger();
                $temp_mails = str_replace(array(",", ";"), ",", $incident->customer->mail);
                $mails = explode(",", $temp_mails);
//                foreach ($images as $image) {
//                    $message->embed('files/evidence/' . $image->name);
//                }
                $message->to($mails)->cc('soc@globalcybersec.com')->subject($subject); //TODO cambiar en producción
//                $message->to($mails)->cc('dlopez@globalcybersec.com')->subject($subject);
                $log->info("0", "Automatic_task", 'Se envió Email a ' . $incident->customer->mail . ' referente al incidente: ' . $incident->id);
            });
    }
}