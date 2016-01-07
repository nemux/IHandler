<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 6/01/16
 * Time: 04:16 PM
 */

namespace App\Http\Controllers\Helpdesk;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Models\Helpdesk\Ticket\Ticket as HelpdeskTicket;
use Models\Helpdesk\Ticket\TicketCriticity as HelpdeskTicketCriticity;
use Models\Helpdesk\Ticket\TicketMessage as HelpdeskTicketMessage;


class TicketController extends Controller
{
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

        $ticket = HelpdeskTicket::whereInternalNumber($internal_number)->first();

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

        $ticket = HelpdeskTicket::whereInternalNumber($internal_number)->first();

        if (!$ticket) {
            abort(404);
        }

        $ticket->updated_at = new \DateTime();
        $ticket->save();

        $this->validate($request, ['message' => 'required'], [], ['message' => 'Mensaje']);

        $message = new HelpdeskTicketMessage();
        $message->ticket_id = $ticket->id;
        $message->user_id = $request->user()->id;
        $message->message = trim($request->get('message'));
        $message->is_customer = false;
        $message->save();

        return redirect()->route('helpdesk.ticket.show', explode('/', $internal_number))
            ->withMessage('Se agregó el comentario al ticket con número de referencia: ' . $ticket->internal_number);

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

        //TODO validar si el estatus del ticket es ... no se puede cambiar la criticidad
        $internal_number = self::getInternalNumber($app, $otrs_customer_id, $ticket_type_abb, $consecutive);

        $ticket = HelpdeskTicket::whereInternalNumber($internal_number)->first();

        if (!$ticket) {
            abort(404);
        }

        $this->validate($request, ['ticket_criticity_id' => 'required'], [], ['ticket_criticity_id' => 'Debe definirse una criticidad para el ticket']);

        $old = strtoupper($ticket->criticity->name);
        $new = strtoupper(HelpdeskTicketCriticity::whereId($request->get('ticket_criticity_id'))->first()->name);

        $ticket->ticket_criticity_id = $request->get('ticket_criticity_id');
        $ticket->save();

        $message = new HelpdeskTicketMessage();
        $message->ticket_id = $ticket->id;
        $message->user_id = $request->user()->id;
        $message->message = "Se cambió la criticidad del ticket de <strong>$old</strong> a <strong>$new</strong>";
        $message->is_customer = false;
        $message->save();

        return redirect()->route('helpdesk.ticket.show', explode('/', $internal_number))
            ->withMessage('Se cambió la severidad del ticket con número de referencia: ' . $ticket->internal_number);
    }

}