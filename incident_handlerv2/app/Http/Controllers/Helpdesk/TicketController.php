<?php

namespace App\Http\Controllers\Helpdesk;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Models\Helpdesk\Ticket\Ticket;
use Models\Helpdesk\Ticket\TicketCriticity;
use Models\Helpdesk\Ticket\TicketMessage;
use Models\Helpdesk\Ticket\TicketMessageFile;
use Models\Helpdesk\Ticket\TicketStatus;


class TicketController extends Controller
{
    protected $email_subject_prefix = '[GCS Helpdesk]';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tickets = Ticket::orderBy('updated_at', 'desc')->with('criticity')->paginate(10);

        return view('helpdesk.index', compact('tickets'));
    }

    /**
     * Muestra la vista del ticket con todos los mensajes que se han enviado entre el cliente y el equipo de Soporte
     *
     * @param $app
     * @param $otrs_customer_id
     * @param $ticket_type_abb
     * @param $consecutive
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($app, $otrs_customer_id, $ticket_type_abb, $consecutive)
    {
        $internal_number = self::getInternalNumber($app, $otrs_customer_id, $ticket_type_abb, $consecutive);

        $ticket = Ticket::whereInternalNumber($internal_number)->first();

        if (!$ticket) {
            abort(404);
        }

        return view('helpdesk.ticket.show', compact('ticket'));

    }

    /**
     * Genera el número interno con base en el  ID del aplicativo, el ID OTRS del cliente y el consecutivo del ticket
     *
     * @param TicketController $app
     * @param TicketController $otrs_customer_id
     * @param TicketController $consecutive
     *
     * @return string
     */
    public static function getInternalNumber($app, $otrs_customer_id, $ticket_type_abb, $consecutive)
    {
        return "$app/$otrs_customer_id/$ticket_type_abb/$consecutive";
    }

    /**
     * Agrega un mensaje a un ticket del helpdesk
     *
     * @param Request $request
     * @param $app
     * @param $otrs_customer_id
     * @param $ticket_type_abb
     * @param $consecutive
     * @return mixed
     */
    public function addMessage(Request $request, $app, $otrs_customer_id, $ticket_type_abb, $consecutive)
    {
        $internal_number = self::getInternalNumber($app, $otrs_customer_id, $ticket_type_abb, $consecutive);

        $ticket = Ticket::whereInternalNumber($internal_number)->first();

        //Si no se encuentra o si el ticket ya está cerrado, no se podrá agregar mensaje
        //Se arroja un error
        if (!$ticket || $ticket->ticket_status_id == 4) {
            abort(404);
        }

        //Valida la petición
        $this->validate($request,
            ['message' => 'required', 'evidence' => 'max:5120'],
            ['evidence.max' => 'El archivo adjunto no puede ser mayor a 5M'],
            ['message' => 'Mensaje', 'evidence' => 'Archivo adjunto']);

        $message = $this->pushMessage($ticket, $request);

        $message_file = $this->addEvidence($ticket, $message, $request);

        //Si el ticket está como abierto, al agregar un mensaje se establece en 2 el estatus
        if ($ticket->ticket_status_id == 1) {
            $ticket->ticket_status_id = 2;
        }

        //Actualiza el campo de update_at del ticket
        $ticket->updated_at = new \DateTime();
        $ticket->save();

        $this->sendEmail($ticket, $message, $message_file);

        return redirect()->route('helpdesk.ticket.show', explode('/', $internal_number))
            ->withMessage('Se agregó el comentario al ticket con número de referencia: ' . $ticket->internal_number);

    }

    /**
     * Agrega un archivo de evidencia al mensaje
     *
     * @param Ticket $ticket
     * @param TicketMessage $message
     * @param Request $request
     * @return bool|TicketMessageFile
     */
    private function addEvidence(Ticket $ticket, TicketMessage $message, Request $request)
    {
        $file = $request->file('evidence');

        //Si se adjuntó un archivo, lo almacena
        if ($file) {
            //TODO verify filesize
            $max_filesize = ini_get('upload_max_filesize');
            $filesize = $request->file('evidence')->getSize();

            $c = new HelpdeskFileController();
            $file = $c->uploadFile($file, $ticket->customer->otrs_customer_id);

            $ticketFile = new TicketMessageFile();
            $ticketFile->file_id = $file->id;
            $ticketFile->ticket_message_id = $message->id;
            $ticketFile->save();

            return $ticketFile;
        } else {
            return false;
        }
    }

    /**
     * Envía un correo cuando se crea un ticket o se agrega un mensaje
     *
     * @param Ticket $ticket
     * @param TicketMessage $ticket_message
     * @param bool|TicketMessageFile $message_file
     * @internal param TicketMessage $message
     */
    public function sendEmail(Ticket $ticket, TicketMessage $ticket_message, $message_file = false)
    {
        \Mail::queue('helpdesk.ticket._preview_ticket_message', compact('ticket', 'ticket_message'), function (Message $message) use ($ticket, $message_file) {
            //Si el mensaje tiene una evidencia, adjuntamos al mensaje
            if ($message_file)
                $message
                    ->attachData(
                        \Storage::disk('helpdesk')->get($message_file->file->path . $message_file->file->name),
                        $message_file->file->original_name
                    );

            //Separa los correos por punto y coma
            $customer_mails = explode(";", $ticket->customer->semicolonSeparatedEmails());
            $message->to($customer_mails, $ticket->customer->name); //Customer

            $message->to($ticket->user->person->contact->email, $ticket->user->person->fullName()); //Customer User

            $message->cc(env('MAIL_SOC'), env('MAIL_SOC_NAME'));//SOC

            //[' . $ticket->customer->otrs_customer_id . ']
            $message->subject($this->email_subject_prefix . '[' . $ticket->internal_number . ']');
        });
    }

    /**
     * Agrega un mensaje al ticket
     *
     * @param Ticket $ticket
     * @param Request $request
     * @param null $message_txt
     * @param bool|false $isnew Define si el ticket es de reciente creación o sólo se le está agregando un mensaje
     * @return TicketMessage
     */
    private function pushMessage(Ticket $ticket, Request $request, $message_txt = null, $isnew = false)
    {
        $message = new TicketMessage();
        $message->ticket_id = $ticket->id;
        $message->user_id = $request->user()->id;
        $message->message = ($message_txt == null) ? trim($request->get('message')) : trim($message_txt);
        $message->is_customer = false;
        $message->save();

        return $message;
    }

    /**
     * Cambia la criticidad de este ticket
     *
     * @param Request $request
     * @param $app
     * @param $otrs_customer_id
     * @param $ticket_type_abb
     * @param $consecutive
     */
    public function changeCriticity(Request $request, $app, $otrs_customer_id, $ticket_type_abb, $consecutive)
    {
        $internal_number = self::getInternalNumber($app, $otrs_customer_id, $ticket_type_abb, $consecutive);

        $ticket = Ticket::whereInternalNumber($internal_number)->first();

        //Si no se encuentra o si el ticket ya está cerrado, no se podrá cdambiar la severidad
        //Se arroja un error
        if (!$ticket || $ticket->ticket_status_id == 3 || $ticket->ticket_status_id == 4) {
            abort(404);
        }

        $old = strtoupper($ticket->criticity->name);
        //Valida que se hayan pasado valores para la severidad y que el nuevo y viejo valor no sean los mismos
        $this->validate($request,
            ['ticket_criticity_id' => 'required|not_in:' . $ticket->criticity->id],
            ['ticket_criticity_id.not_in' => 'El valor del campo SEVERIDAD debe ser diferente a ' . $old],
            ['ticket_criticity_id' => 'Severidad']);

        $new = strtoupper(TicketCriticity::whereId($request->get('ticket_criticity_id'))->first()->name);

        //Si el ticket está como abierto, al agregar un mensaje se establece en 2 el estatus
        if ($ticket->ticket_status_id == 1) {
            $ticket->ticket_status_id = 2;
        }
        $ticket->ticket_criticity_id = $request->get('ticket_criticity_id');
        $ticket->save();

        $message = $this->pushMessage($ticket, $request, "Se cambió la criticidad del ticket de <strong>$old</strong> a <strong>$new</strong>");

        $this->sendEmail($ticket, $message);

        return redirect()->route('helpdesk.ticket.show', explode('/', $internal_number))
            ->withMessage('Se cambió la severidad del ticket con número de referencia: ' . $ticket->internal_number);
    }

    public function changeStatus(Request $request, $app, $otrs_customer_id, $ticket_type_abb, $consecutive)
    {
        $internal_number = self::getInternalNumber($app, $otrs_customer_id, $ticket_type_abb, $consecutive);

        $ticket = Ticket::whereInternalNumber($internal_number)->first();

        //Si no se encuentra o si el ticket ya está cerrado, no se podrá cdambiar la severidad
        //Se arroja un error
        if (!$ticket || $ticket->ticket_status_id == 4) {
            abort(404);
        }

        $old_status = $ticket->status;
        //Valida que se hayan pasado valores para el estatus y que el nuevo y viejo valor no sean los mismos
        $validStatus = self::getValidStatusValues($old_status->id);

        $this->validate($request,
            ["ticket_status_id" => "required|not_in:{$old_status->id}{$validStatus->in}"],
            ['ticket_status_id.not_in' => "El valor de ESTATUS debe ser diferente a {$old_status->name}",
                'ticket_status_id.in' => $validStatus->message],
            ['ticket_status_id' => 'Estatus']);

        $new_status = TicketStatus::whereId($request->get('ticket_status_id'))->first();

        $ticket->ticket_status_id = $new_status->id;
        $ticket->save();

        $message = $this->pushMessage($ticket, $request, "Se cambió el estatus del ticket de <strong>{$old_status->name}</strong> a <strong>{$new_status->name}</strong>");

        $this->sendEmail($ticket, $message);


        return redirect()->route('helpdesk.ticket.show', explode('/', $internal_number))
            ->withMessage('Se cambió el Estatus del ticket con número de referencia: ' . $ticket->internal_number);
    }

    /**
     * Para un cambio de estatus, define qué valores posibles puede recibir con base en un estatus
     *
     * @param $old_status_id
     * @return object
     */
    private function getValidStatusValues($old_status_id)
    {

        switch ($old_status_id) {
            case 1:
                return (object)['in' => '|in:2', 'message' => 'El ticket sólo puede pasar a PENDIENTE'];
                break;
            case 2:
                return (object)['in' => '|in:3', 'message' => 'El ticket sólo puede pasar a RESUELTO'];
                break;
            case 3:
                return (object)['in' => '|in:4', 'message' => 'El ticket sólo puede pasar a CERRADO'];
                break;
            default:
                return (object)['in' => '|in:null', 'message' => 'El ticket sólo puede pasar a NULL'];
        }
    }

    /**
     * Devuelve una vista HTML renderizada de un Ticket
     *
     * @param TicketMessage $message
     * @return string
     */
    private function renderTicketMessageHtml(TicketMessage $message)
    {
        return view('helpdesk.ticket._preview_ticket_message', compact('message'))->render();
    }

}