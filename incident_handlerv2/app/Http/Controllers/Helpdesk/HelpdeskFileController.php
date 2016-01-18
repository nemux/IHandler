<?php

namespace App\Http\Controllers\Helpdesk;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Models\Helpdesk\File;
use Models\Helpdesk\Ticket\TicketMessageFile;

class HelpdeskFileController extends Controller
{


    /**
     * Retrieves the file stored on filesystem
     *
     * @param $filename
     * @return mixed
     */
    public function getFile($ticket_message_id, $filename)
    {
        $ticketmessagefile = TicketMessageFile::whereTicketMessageId($ticket_message_id)->first();

        \Log::info($ticketmessagefile);

        //Si se encontró el objeto con el ticket_message_id pasado como parámetro del método
        if ($ticketmessagefile) {
            //Obtener el customer_id del usuario que está logeado
            $customer_id = \Request::user()->customer_id;
            //Obtener el ticket para comparar los customer_id del usuario y el ticket
            $ticket = $ticketmessagefile->ticketmessage->ticket;

            //Obtener el file con base en el file_id y el filename
            $file = File::whereId($ticketmessagefile->file_id)
                ->whereName($filename)
                ->first();

            \Log::info($file);

            //Si se encontró el archivo y los customer_id son iguales
            if ($file) {
                $file_ = \Storage::disk('helpdesk')->get($file->path . '/' . $file->name);

                //Regresa el archivo
                return response($file_, 200)->header('Content-Type', $file->mime_type);
            }
        }

        abort(404);

    }
}
