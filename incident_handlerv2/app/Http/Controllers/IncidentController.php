<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Library\Pdf;
use App\Library\WordGenerator;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Models\IncidentManager\Evidence\Evidence;
use Models\IncidentManager\Evidence\EvidenceType;
use Models\IncidentManager\Incident\Annex;
use Models\IncidentManager\Incident\History;
use Models\IncidentManager\Incident\Incident;
use Models\IncidentManager\Incident\IncidentAttackCategory;
use Models\IncidentManager\Incident\IncidentAttackSignature;
use Models\IncidentManager\Incident\IncidentCustomerSensor;
use Models\IncidentManager\Incident\IncidentEvent;
use Models\IncidentManager\Incident\IncidentEvidence;
use Models\IncidentManager\Incident\Note;
use Models\IncidentManager\Incident\Recommendation;
use Models\IncidentManager\Person\PersonContact;
use Models\IncidentManager\Ticket\Ticket;
use Psy\Util\Json;

class IncidentController extends Controller
{

    protected $email_subject_prefix = '[GCS-IM][Incidente]'; //TODO move to .env file

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Incident::select('incident.id',
            'ticket.internal_number',
            'incident.title',
            'user.username',
            'incident.detection_time',
            'ticket_status.name as status',
            'criticity.name as criticity');

        $query->leftJoin('ticket', 'ticket.incident_id', '=', 'incident.id')
            ->leftJoin('ticket_status', 'ticket_status.id', '=', 'ticket.ticket_status_id')
            ->leftJoin('user', 'user.id', '=', 'incident.user_id')
            ->leftJoin('criticity', 'criticity.id', '=', 'incident.criticity_id')
            ->with('signatures.signature')
            ->with('sensors.sensor');

        $incidents = $query->orderBy('id', 'desc')->paginate(10);

        return view('incident.index', compact('incidents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $case = new \Models\IncidentManager\Incident\Incident();
        return view('incident.create', compact('case'))->withPostroute('file.upload.incident');
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
        $incident->occurrence_time = date('Y-m-d H:i', strtotime(str_replace('/', '-', $occurrence_time))) . ':00';

        $detection_time = $request->get('detection_date') . " " . $request->get('detection_time');
        $incident->detection_time = date('Y-m-d H:i', strtotime(str_replace('/', '-', $detection_time))) . ':00';

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
        $ticket->internal_number = 'Por asignar...';
        $ticket->save();

        //Evidencias
        $evidences = EvidenceController::getEvidences($request);
        $incidentEvidences = array();
        foreach ($evidences as $evidence) {
            $incident_evidence = new IncidentEvidence();
            $incident_evidence->incident_id = $incident->id;
            $incident_evidence->evidence_id = $evidence->id;
            $incident_evidence->evidence_type_id = 2;
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

        return redirect()->route('incident.show', $incident->id)->withMessage('Se creó el Incidente ' . $incident->title);
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
        $status = $case->ticket->ticket_status_id;

        if ($status > 2) {
            abort(404);
        }

        return view('incident.edit', compact('case'))->withPostroute('file.upload.incident');
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
        //Incidente
        $incident = Incident::whereId($id)->first();
        $status = $incident->ticket->ticket_status_id;

        //History
        $history = History::store($incident);

        //Si el incidente tiene un estatus mayor a Investigación (resuelto, cerrado, falso positivo, cerrado autom) no se podrá almacenar nada
        if ($status > 2) {
            abort(404);
        }

        if ($status == 1) {
            $incident->title = $request->get('title');
            $occurrence_time = $request->get('occurrence_date') . " " . $request->get('occurrence_time');
            $incident->occurrence_time = date('Y-m-d H:i', strtotime(str_replace('/', '-', $occurrence_time))) . ':00';

            $detection_time = $request->get('detection_date') . " " . $request->get('detection_time');
            $incident->detection_time = date('Y-m-d H:i', strtotime(str_replace('/', '-', $detection_time))) . ':00';

            $incident->attack_flow_id = $request->get('flow_id');
            $incident->criticity_id = $request->get('criticity_id');
            $incident->impact = $request->get('impact');
            $incident->risk = $request->get('risk');
            $incident->attack_type_id = $request->get('attack_type_id');
            $incident->customer_id = $request->get('customer_id');
        }

        if ($status == 1 || $status == 2) {
            $incident->description = $request->get('description');
            $incident->recommendation = $request->get('recommendation');
            $incident->reference = $request->get('reference');
        }
        $incident->save();

        if ($status == 1 || $status == 2) {
            //Evidencias
            $evidences = EvidenceController::getEvidences($request);
            $incidentEvidences = array();
            foreach ($evidences as $evidence) {
                $incident_evidence = IncidentEvidence::whereIncidentId($incident->id)->whereEvidenceId($evidence->id)->first();
                if (!isset($incident_evidence))
                    $incident_evidence = new IncidentEvidence();
                $incident_evidence->incident_id = $incident->id;
                $incident_evidence->evidence_id = $evidence->id;
                $incident_evidence->evidence_type_id = 2;
                $incident_evidence->note = 'SN';
                $incident_evidence->save();
                array_push($incidentEvidences, $incident_evidence);
            }
        }

        if ($status == 1) {
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
        }

        if ($status == 1) {
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
        }

        if ($status == 1) {
            //Sensores
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
        }

        if ($status == 1 || $status == 2) {
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
        }

        return redirect()->route('incident.show', $incident->id)->withMessage('Se actualizó el Incidente ' . $incident->title);
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
        $pdf = Pdf::generatePdf($case, 'pdf.incident');
        $docName = $case->ticket->internal_number ? $case->ticket->internal_number : 'ID' . $case->id;

        if ($download) {
            return $pdf->download($docName . '.pdf');
        } else {
            return $pdf->stream($docName . '.pdf');
        }
    }

    /**
     * Método que se ejecuta en una petición GET para generar el Doc de Word del incidente
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function getDoc($id)
    {
        $case = Incident::whereId($id)->first();
        $doc = new WordGenerator(Incident::class, WordGenerator::TYPE_TABLE);
        $doc->addCases($case);
        $file = $doc->streamDocument();

        $docname = $case->ticket->internal_number ? $case->ticket->internal_number : 'ID' . $case->id;

        $headers = array(
            "Content-Type" => "application/vnd.ms-word;charset=utf-8",
            "Content-Disposition" => "attachment;Filename={$docname}.docx"
        );

        return \Response::make($file, 200, $headers);
    }

    /**
     * Envia un correo electronico, adjuntando en PDF el reporte del caso.
     *
     * @param Incident $incident
     * @param string $extra_info
     */
    public function sendEmail(Incident $incident, $extra_info = '')
    {
        \Mail::send('email.incident', compact('incident', 'extra_info'), function (Message $message) use ($incident) {
            //Adjuntamos las evidencias cargadas
            foreach ($incident->evidences as $evidence) {
                $file = $evidence->evidence->path . $evidence->evidence->name;
                $name = $evidence->evidence->original_name;

                $message->attachData(\Storage::get($file), $name);
            }

            $pdf = Pdf::generatePdf($incident, 'pdf.incident');

            $mailTo = PersonContact::compareEmail($incident->user->person->contact->email);

            $message->attachData($pdf->output(), $incident->title . '.pdf');
            $message->to($mailTo, \Auth::user()->person->fullName()); //TODO Enviar correo al cliente, al soc y al usuario que generó el incidente
//            $message->cc('soc@globalcybersec.com','Blue Team::Global Cybersec');
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
        $status = $incidentEvidence->incident->ticket->ticket_status_id;

        if ($incidentEvidence != null && $status <= 2) {
            $incidentEvidence->delete();
            return \Response::json(['status' => 0, 'message' => 'Se eliminó correctamente la Evidencia']);
        } else {
            return \Response::json(['status' => 1, 'message' => 'No se pudo eliminar la Evidencia']);
        }
    }

    /**
     * Actualiza el campo "note" de una evidencia de un incidente
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateEvidence(Request $request)
    {
        $ie_id = $request->get('id');
        $ie_note = $request->get('note');
        $ie = IncidentEvidence::whereId($ie_id)->first();

        if ($ie != null) {
            $ie->note = $ie_note;
            $ie->save();

            return \Response::json(['status' => 0, 'message' => 'Se actualizó correctamente la Evidencia']);
        } else {
            return \Response::json(['status' => 1, 'message' => 'No se pudo actualizar la Evidencia']);
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
        $status = Incident::whereId($incidentId)->first()->ticket->ticket_status_id;

        if (isset($incidentId) && isset($sourceId) && isset($targetId)) {
            $incidentEvent = null;
            if ($status <= 2) {
                if ($sourceId != 'null' && $targetId != 'null') {
                    $incidentEvent = IncidentEvent::whereIncidentId($incidentId)->whereSourceMachineId($sourceId)->whereTargetMachineId($targetId)->delete();
                } else if ($sourceId != 'null' && $targetId === 'null') {
                    $incidentEvent = IncidentEvent::whereIncidentId($incidentId)->whereSourceMachineId($sourceId)->delete();
                } else if ($sourceId === 'null' && $targetId != 'null') {
                    $incidentEvent = IncidentEvent::whereIncidentId($incidentId)->whereTargetMachineId($targetId)->delete();
                } else {
                    return \Response::json(['status' => 1, 'message' => 'No se pudieron eliminar los elementos según el criterio']);
                }
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

    /**
     * Cambia un incidente
     * @param Request $request
     * @return bool|string
     */
    public function changeStatus(Request $request)
    {
        $incidentId = $request->get('id');
        $newTicketStatusId = $request->get('status');
        $incident = Incident::whereId($incidentId)->first();

        \Log::info($newTicketStatusId);
        if ($newTicketStatusId == 5 || $newTicketStatusId == 4) {
//            \Log::info('is 5 or 4');

            $files = $request->file('fp-files');

            if ($newTicketStatusId == 5) {
//                \Log::info('is 5');
                $evidenceType = EvidenceType::whereName('Falso Positivo')->first();
            } else if ($newTicketStatusId == 4) {
//                \Log::info('is 4');
                $evidenceType = EvidenceType::whereName('Cerrado')->first();
            }

            foreach ($files as $file) {
//                \Log::info($file);
                $evidence = EvidenceController::uploadSingleFile($file);
                $incidentEvidence = new IncidentEvidence();
                $incidentEvidence->incident_id = $incident->id;
                $incidentEvidence->evidence_id = $evidence->id;
                $incidentEvidence->evidence_type_id = $evidenceType->id;
                $incidentEvidence->save();
            }
        }

        $ticket = $incident->ticket;
        $oldTicketStatusId = $ticket->ticket_status_id;

        if ($oldTicketStatusId == 1 && ($newTicketStatusId == 2 || $newTicketStatusId == 5)) {
            //De abierto, puede pasar a investigación o falso positivo

            $ticketCount = Incident::whereCustomerId($incident->customer->id)
                ->join('ticket', 'ticket.incident_id', '=', 'incident.id')
                ->where('ticket.internal_number', '!=', 'Por asignar...')//Se valida que cuente los tickets asignados
                ->where('ticket.internal_number', '!=', '')//Con un numero interno definido
                ->where('ticket.ticket_status_id', '>', 1)//Contar los tickets que no est{an abiertos
                ->whereNotNull('ticket.internal_number')
                ->whereNull('ticket.deleted_at')
                ->count();

            //Se guarda el numero interno y el estatus antes de generar el ticket en el OTRS para que no genere tráfico en la generación de los consecutivos
            $ticket->internal_number = strtoupper($incident->customer->otrs_customer_id) . '-' . ($ticketCount + 1);
            $ticket->ticket_status_id = $newTicketStatusId;
            $ticket->save();

            if ($newTicketStatusId == 2) {
                $message = 'Se cambió el estatus del Incidente y se envió el correo al cliente';
                $this->sendEmail($incident, $message);
                return Json::encode(['status' => true, 'message' => $message]);

            } else {
                return redirect()->route('incident.show', $incident->id)->withMessage('Se cambió el estatus del Incidente a Falso Positivo');
            }
        } else if ($oldTicketStatusId == 2 && ($newTicketStatusId == 3 || $newTicketStatusId == 5)) {
            //De Investigación, sólo puede pasar a resuelto, cerrado o falso positivo
            $ticket->ticket_status_id = $newTicketStatusId;
            $ticket->save();

            if ($newTicketStatusId == 3) {
                $message = 'Se cambió el estatus del Incidente a Resuelto';
                $this->sendEmail($incident, $message);
                return Json::encode(['status' => true, 'message' => $message]);
            } else
                return Json::encode(['status' => true, 'message' => 'Se cambió el estatus del Falso Positivo']);

        } else if ($oldTicketStatusId == 3 && ($newTicketStatusId == 4 || $newTicketStatusId == 6)) {
            //De Resuelto sólo puede pasar a Cerrado o Cerrado automático
            $ticket->ticket_status_id = $newTicketStatusId;
            $ticket->save();

            if ($newTicketStatusId == 4) {
                $this->sendEmail($incident, "Se cerró el Ticket del Incidente");
                return redirect()->route('incident.show', $incident->id)->withMessage('Se cerró el Incidente y se envió el correo al cliente');
            } else
                return Json::encode(['status' => true, 'message' => 'Se cambió el estatus del Incidente a Cerrado Automático']);

        } else if ($oldTicketStatusId == 4 || $oldTicketStatusId == 5 || $oldTicketStatusId == 6) {
            return Json::encode(['status' => false, 'message' => "El estatus {$oldTicketStatusId} ya es un estado final. No se puede transicionar un ticket con este estatus"]);
        } else {
            return Json::encode(['status' => false, 'message' => "Error al pasar un incidente del estatus {$oldTicketStatusId} al estatus {$newTicketStatusId}"]);
        }
    }

    /**
     * Recibe una peticion para agregar un anexo a un incidente
     *
     * @param Request $request
     * @return mixed
     */
    public function storeAnnex(Request $request)
    {
        $status = Incident::whereId($request->get('incident_id'))->first()->ticket->ticket_status_id;
        if ($status > 2) {
            abort(404);
        }

        Annex::validateCreate($request, $this);

        $annex = new Annex();
        $annex->title = $request->get('title');
        $annex->field = $request->get('field');
        $annex->content = $request->get('content');
        $annex->incident_id = $request->get('incident_id');
        $annex->save();

        return redirect()->route('incident.show', $request->get('incident_id'))->withMessage('Se agregó el anexo al incidente');
    }

    /**
     * @param Request $request
     * @return string
     */
    public function storeRecommendation(Request $request)
    {
        $incident = Incident::whereId($request->get('incident_id'))->first();
        $status = $incident->ticket->ticket_status_id;

        if ($status > 2) {
            abort(404);
        }

        Recommendation::validateCreate($request, $this);


        $recomm = new Recommendation();
        $recomm->incident_id = $request->get('incident_id');
        $recomm->content = $request->get('content');
        $recomm->otrs_article_id = '';
        $recomm->save();

        $this->sendEmail($incident, 'Se agregó una recomendación al Incidente'); //Confirmar que cuando se agrega una recomendación se envíe un correo

        return redirect()
            ->route('incident.show', $request->get('incident_id'))
            ->withMessage('Se agregó la recomendación al incidente');
    }

    /**
     * Recibe una peticion para agregar una nota a un incidente
     *
     * @param Request $request
     * @return mixed
     */
    public function storeNote(Request $request)
    {
        $status = Incident::whereId($request->get('incident_id'))->first()->ticket->ticket_status_id;
        if ($status > 3) {
            abort(404);
        }

        Note::validateCreate($request, $this);

        $note = new Note();
        $note->incident_id = $request->get('incident_id');
        $note->content = $request->get('content');
        $note->save();

        return redirect()->route('incident.show', $request->get('incident_id'))->withMessage('Se agregó la observación al incidente');
    }

    /**
     * Recibe una peticion para eliminar una nota de un incidente
     *
     * @param Request $request
     * @return mixed
     */
    public function deleteNote(Request $request)
    {
//        \Log::info($request->except('_token'));

        $note = Note::whereId($request->get('id'))->first();
        $status = $note->incident->ticket->ticket_status_id;

        if ($note != null && $status <= 2) {
            $note->delete();
            return \Response::json(['status' => 0, 'message' => 'Se eliminó correctamente la Observación']);
        } else {
            return \Response::json(['status' => 1, 'message' => 'No se pudo eliminar la Observación']);
        }
    }

    public function getEvidenceFile($incident_evidence_id)
    {
        $evidence_id = IncidentEvidence::whereId($incident_evidence_id)->first()->evidence_id;

        $evidence = Evidence::whereId($evidence_id)->first();

        $file = \Storage::get($evidence->path . $evidence->name);

        $headers = ['Content-Type' => $evidence->mime_type, 'Content-Disposition' => 'inline; filename="' . $evidence->original_name . '"'];

        //Regresa el archivo
        return response($file, 200, $headers);
    }
}
