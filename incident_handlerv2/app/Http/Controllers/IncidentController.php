<?php

namespace App\Http\Controllers;

use App\Models\Incident\Incident;
use App\Models\Incident\IncidentAttackCategory;
use App\Models\Incident\IncidentAttackSignature;
use App\Models\Incident\IncidentCustomerSensor;
use App\Models\Incident\IncidentEvent;
use App\Models\Incident\IncidentEvidence;
use App\Models\Person\PersonContact;
use App\Models\Ticket\Ticket;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Library\Otrs\OtrsClient;
use Mockery\CountValidator\Exception;
use Psy\Util\Json;
use Symfony\Component\Debug\Exception\FatalErrorException;

class IncidentController extends Controller
{

    protected $email_subject_prefix = '[GCS-IH][Incidente]';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incidents = Incident::all();
        return view('incident.index', compact('incidents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('incident.create')->withPostroute('file.upload.incident');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Incident::validateCreate($request, $this);
        //TODO validate the rest of the fields

        //Incidente
        $incident = new Incident();
        $incident->title = $request->get('title');
        $incident->description = $request->get('description');
        $incident->recommendation = $request->get('recommendation');
        $incident->reference = $request->get('reference');

        $occurrence_time = $request->get('occurrence_date') . " " . $request->get('occurrence_time');
        $incident->occurrence_time = date('Y-m-d H:i', strtotime(str_replace('/', '-', $occurrence_time)));

        $detection_time = $request->get('detection_date') . " " . $request->get('detection_time');
        $incident->detection_time = date('Y-m-d H:i', strtotime(str_replace('/', '-', $detection_time)));

        $incident->attack_flow_id = $request->get('flow_id');
        $incident->criticity_id = $request->get('criticity_id');
        $incident->impact = $request->get('impact');
        $incident->risk = $request->get('risk');
        $incident->attack_type_id = $request->get('attack_type_id');
        $incident->customer_id = $request->get('customer_id');
        $incident->save();

        $ticket = new Ticket();
        $ticket->incident_id = $incident->id;
        $ticket->ticket_status_id = 1;
        $ticket->save();

        //Evidencias
        $evidences = EvidenceController::getEvidences($request);
        $incidentEvidences = array();
        foreach ($evidences as $evidence) {
            $incident_evidence = new IncidentEvidence();
            $incident_evidence->incident_id = $incident->id;
            $incident_evidence->evidence_id = $evidence->id;
            $incident_evidence->note = 'SN';
            $incident_evidence->save();
            array_push($incidentEvidences, $incident_evidence);
        }

        //Eventos
        $event_machines = IncidentEventController::getMachines($request);
        $incidentEvents = array();
        foreach ($event_machines as $machine) {
            $event = new IncidentEvent();
            $event->incident_id = $incident->id;
            $event->source_machine_id = $machine['source']->id;
            $event->target_machine_id = $machine['target']->id;
            $event->payload = $machine['payload'];
            $event->event_relation = $machine['event_relation'];
            $event->save();

            array_push($incidentEvents, $event);
        }

        //Categorías
        $categories = $request->get('category_id');
        $incidentCategories = array();
        foreach ($categories as $id) {
            $item = new IncidentAttackCategory();
            $item->incident_id = $incident->id;
            $item->attack_category_id = $id;
            $item->save();
            array_push($incidentCategories, $item);
        }

        //Sensor
        $sensors = $request->get('sensor_id');
        $incidentSensors = array();
        foreach ($sensors as $id) {
            $item = new IncidentCustomerSensor();
            $item->incident_id = $incident->id;
            $item->customer_sensor_id = $id;
            $item->save();
            array_push($incidentSensors, $item);
        }

        //Firmas
        $signatures = $request->get('signature');
        $incidentSignatures = array();
        foreach ($signatures as $id) {
            $item = new IncidentAttackSignature();
            $item->incident_id = $incident->id;
            $item->attack_signature_id = $id;
            $item->save();
            array_push($incidentSignatures, $item);
        }

        return redirect()->route('incident.index')->withMessage('Se creó el Incidente ' . $incident->title);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $case = Incident::whereId($id)->first();

        return view('incident.show', compact('case', 'events'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $case = Incident::whereId($id)->first();

        return view('incident.edit', compact('case'))->withPostroute('file.upload.incident');;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        \Log::info($request->except('_token'));

        //TODO Validate request fields?

        //Incidente
        //TODO validate when got another status, can be filled the basic data of incident
        $incident = Incident::whereId($id)->first();
        $incident->title = $request->get('title');
        $incident->description = $request->get('description');
        $incident->recommendation = $request->get('recommendation');
        $incident->reference = $request->get('reference');

        $occurrence_time = $request->get('occurrence_date') . " " . $request->get('occurrence_time');
        $incident->occurrence_time = date('Y-m-d H:i', strtotime(str_replace('/', '-', $occurrence_time)));

        $detection_time = $request->get('detection_date') . " " . $request->get('detection_time');
        $incident->detection_time = date('Y-m-d H:i', strtotime(str_replace('/', '-', $detection_time)));

        $incident->attack_flow_id = $request->get('flow_id');
        $incident->criticity_id = $request->get('criticity_id');
        $incident->impact = $request->get('impact');
        $incident->risk = $request->get('risk');
        $incident->attack_type_id = $request->get('attack_type_id');
        $incident->customer_id = $request->get('customer_id');
        $incident->save();

        //Evidencias
        $evidences = EvidenceController::getEvidences($request);
        $incidentEvidences = array();
        foreach ($evidences as $evidence) {
            $incident_evidence = IncidentEvidence::whereIncidentId($incident->id)->whereEvidenceId($evidence->id)->first();
            if (!isset($incident_evidence))
                $incident_evidence = new IncidentEvidence();
            $incident_evidence->incident_id = $incident->id;
            $incident_evidence->evidence_id = $evidence->id;
            $incident_evidence->note = 'SN';
            $incident_evidence->save();
            array_push($incidentEvidences, $incident_evidence);
        }

        //Eventos
        $event_machines = IncidentEventController::getMachines($request);
        $incidentEvents = array();
        foreach ($event_machines as $machine) {
            $event = new IncidentEvent();
            $event->incident_id = $incident->id;
            $event->source_machine_id = $machine['source']->id;
            $event->target_machine_id = $machine['target']->id;
            $event->payload = $machine['payload'];
            $event->save();

            array_push($incidentEvents, $event);
        }

        //Categorías
        $oldCategories = IncidentAttackCategory::whereIncidentId($incident->id)->get();
        foreach ($oldCategories as $old)
            $old->delete();

        $categories = $request->get('category_id');
        $incidentCategories = array();
        foreach ($categories as $id) {
            $item = new IncidentAttackCategory();
            $item->incident_id = $incident->id;
            $item->attack_category_id = $id;
            $item->save();
            array_push($incidentCategories, $item);
        }

        //Sensor
        $oldSensors = IncidentCustomerSensor::whereIncidentId($incident->id)->get();
        foreach ($oldSensors as $old)
            $old->delete();

        $sensors = $request->get('sensor_id');
        $incidentSensors = array();
        foreach ($sensors as $id) {
            $item = new IncidentCustomerSensor();
            $item->incident_id = $incident->id;
            $item->customer_sensor_id = $id;
            $item->save();
            array_push($incidentSensors, $item);
        }

        //Firmas
        $oldSignatures = IncidentAttackSignature::whereIncidentId($incident->id)->get();
        foreach ($oldSignatures as $old)
            $old->delete();

        $signatures = $request->get('signature');
        $incidentSignatures = array();
        foreach ($signatures as $id) {
            $item = new IncidentAttackSignature();
            $item->incident_id = $incident->id;
            $item->attack_signature_id = $id;
            $item->save();
            array_push($incidentSignatures, $item);
        }

        return redirect()->route('incident.index')->withMessage('Se actualizó el Incidente ' . $incident->title);
    }

    /**
     * Método que se ejecuta en una petición GET para generar el PDF del incidente
     *
     * @param $id
     * @param bool|false $download Define si se descarga el PDF o se muestra en el navegador
     * @return \Illuminate\Http\Response
     */
    public function getPdf($id, $download = false)
    {
        $case = Incident::whereId($id)->first();
        $pdf = PdfController::generatePdf($case, 'pdf.incident');
        $docName = $case->title . '.pdf';

        if ($download) {
            return $pdf->download($docName);
        } else {
            return $pdf->stream($docName);
        }
    }

    /**
     * Envia un correo electronico, adjuntando en PDF el reporte del caso.
     * @param Incident $incident
     */
    public function sendEmail(Incident $incident)
    {
        \Mail::send('email.incident', compact('incident'), function ($message) use ($incident) {
            $pdf = PdfController::generatePdf($incident, 'pdf.incident');

            $mailTo = PersonContact::compareEmail(\Auth::user()->person->contact->email);

            $message->attachData($pdf->output(), $incident->title . '.pdf');
            $message->to($mailTo, \Auth::user()->person->fullName());
            $message->subject($this->email_subject_prefix . '[' . $incident->customer->otrs_customer_id . '] ' . $incident->title);
        });
    }

    /**
     * Método ejecutado en una petición GET para el envío de correo del incidente
     *
     * @param $id
     * @return mixed
     */
    public function email($id)
    {
        $incident = Incident::whereId($id)->first();
        $this->sendEmail($incident);
        return redirect()->route('incident.show', $id)->withMessage('Se envió el correo electrónico del Incidente ' . $incident->title);
    }

    /**
     * Muestra una vista previa del incidente tal como se creará el documento PDF
     * @param $id
     * @return \Illuminate\View\View
     */
    public function preview($id)
    {
        $case = Incident::whereId($id)->first();
        $isPdf = false;

        return view('pdf.incident', compact('case', 'isPdf'));
    }

    /**
     * Deletes a relation from incident and evidence
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteEvidence($id)
    {
        $incidentEvidence = IncidentEvidence::whereId($id)->first();

        if ($incidentEvidence != null) {
            $incidentEvidence->delete();
            return \Response::json(['status' => 0, 'message' => 'Se eliminó correctamente la Evidencia']);
        } else {
            return \Response::json(['status' => 1, 'message' => 'No se pudo eliminar la Evidencia']);
        }
    }

    /**
     * Deletes a relation from incident and event
     *
     * @param $incidentId
     * @param $sourceId
     * @param $targetId
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteEvent($incidentId, $sourceId, $targetId)
    {
        \Log::info($incidentId . " " . $sourceId . " " . $targetId);
        if (isset($incidentId) && isset($sourceId) && isset($targetId)) {
            $incidentEvent = null;
            if ($sourceId !== 'null' && $targetId !== 'null') {
                $incidentEvent = IncidentEvent::whereIncidentId($incidentId)->whereSourceMachineId($sourceId)->whereTargetMachineId($targetId)->delete();
            } else if ($sourceId !== 'null' && $targetId === 'null') {
                $incidentEvent = IncidentEvent::whereIncidentId($incidentId)->whereSourceMachineId($sourceId)->delete();
            } else if ($sourceId === 'null' && $targetId !== 'null') {
                $incidentEvent = IncidentEvent::whereIncidentId($incidentId)->whereTargetMachineId($targetId)->delete();
            } else {
                return \Response::json(['status' => 1, 'message' => 'No se pudieron eliminar los elementos según el criterio']);
            }

            if ($incidentEvent != null) {
                return \Response::json(['status' => 0, 'message' => 'Se eliminó correctamente el Evento']);
            } else {
                return \Response::json(['status' => 1, 'message' => 'No se pudo eliminar el o los Eventos']);
            }
        } else {
            return \Response::json(['status' => 1, 'message' => 'Faltan parámetros']);
        }
    }

    public function changeStatus(Request $request)
    {
        $incidentId = $request->get('id');
        $newTicketStatusId = $request->get('status');

        $incident = Incident::whereId($incidentId)->first();
        $ticket = $incident->ticket;
        $oldTicketStatusId = $ticket->ticket_status_id;

        if ($oldTicketStatusId === 1 && ($newTicketStatusId !== 2 || $newTicketStatusId !== 5)) {
            //De abierto, puede pasar a investigación o falso positivo

            $otrs = new OtrsClient();
            $otrsTicket = $otrs->createTicket($incident->title, $incident->risk, $incident->customer->otrs_user_id, $incident->customer->semicolonSeparatedEmails(), $incident->renderHtml());

            if (!isset($otrsTicket['error_code'])) {

                $ticketCount = Incident::whereCustomerId(2)
                    ->join('ticket', 'ticket.incident_id', '=', 'incident.id')
                    ->where('ticket.internal_number', '!=', '')
                    ->count();

                $ticket->otrs_ticket_id = $otrsTicket['TicketID'];
                $ticket->otrs_ticket_number = $otrsTicket['TicketNumber'];
                $ticket->internal_number = strtoupper($incident->customer->otrs_customer_id) . '-' . ($ticketCount + 1);
                $ticket->ticket_status_id = $newTicketStatusId;
                $ticket->save();

                if ($newTicketStatusId == 2) {
                    $this->sendEmail($incident);

                    return Json::encode(['status' => true, 'message' => 'Se cambió el estatus del Incidente y se envió el correo al cliente']);
                } else {
                    \Log::info('redirecting');

                    return Json::encode(['status' => true, 'message' => 'Se cambió el estatus del Incidente a Falso Positivo']);
                }

            } else {
                return $this->createOtrsErrorResult($otrsTicket);
            }
        } else if ($oldTicketStatusId === 2 && ($newTicketStatusId !== 3 || $newTicketStatusId !== 5)) {
            //De Investigación, sólo puede pasar a resuelto, cerrado o falso positivo
            $ticket->ticket_status_id = $newTicketStatusId;
            $ticket->save();

            if ($newTicketStatusId === 3)
                return Json::encode(['status' => true, 'message' => 'Se cambió el estatus del Incidente a Resuelto']);
            else
                return Json::encode(['status' => true, 'message' => 'Se cambió el estatus del Falso Positivo']);

        } else if ($oldTicketStatusId === 3 && ($newTicketStatusId !== 4 || $newTicketStatusId !== 6)) {
            //De Resuelto sólo puede pasar a Cerrado o Cerrado automático
            $ticket->ticket_status_id = $newTicketStatusId;
            $ticket->save();

            if ($newTicketStatusId === 4)
                return Json::encode(['status' => true, 'message' => 'Se cambió el estatus del Incidente a Cerrado']);
            else
                return Json::encode(['status' => true, 'message' => 'Se cambió el estatus del Incidente a Cerrado Automático']);

        } else if ($oldTicketStatusId === 4 || $oldTicketStatusId === 5 || $oldTicketStatusId === 6) {
            return Json::encode(['status' => false, 'message' => "El estatus {$oldTicketStatusId} ya es un estado final. No se puede transicionar un ticket con este estatus"]);
        } else {
            return Json::encode(['status' => false, 'message' => "Error al pasar un incidente del estatus {$oldTicketStatusId} al estatus $newTicketStatusId"]);
        }
    }

    private function createOtrsErrorResult($otrsResponse)
    {
        return Json::encode(['status' => false, 'message' => '(Error Code: ' . $otrsResponse['error_code'] . ') Message: ' . $otrsResponse['error_description']]);
    }

    public function test()
    {
        $ticketCount = Incident::whereCustomerId(2)
            ->join('ticket', 'ticket.incident_id', '=', 'incident.id')
            ->where('ticket.internal_number', '!=', '')
            ->count();
        \Log::info($ticketCount);

//        $incident = Incident::whereId(19)->first();
//        $emails = '';
//        foreach ($incident->customer->contacts as $index => $contact) {
//            $emails .= $contact->person->contact->email;
//            if ($index < count($incident->customer->contacts) - 1) {
//                $emails .= ';';
//            }
//        }
//        $otrs = new OtrsClient();
//        \Log::info($incident->risk);
//        $otrsTicket = $otrs->createTicket($incident->title, $incident->risk, $incident->customer->otrs_user_id, $emails, $incident->renderHtml());
////
//        \Log::info($otrsTicket);
    }

    public function postTest(Request $request)
    {

    }
}
