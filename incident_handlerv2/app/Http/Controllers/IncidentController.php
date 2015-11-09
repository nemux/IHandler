<?php

namespace App\Http\Controllers;

use App\Models\Incident\Incident;
use App\Models\Incident\IncidentAttackCategory;
use App\Models\Incident\IncidentAttackSignature;
use App\Models\Incident\IncidentCustomerSensor;
use App\Models\Incident\IncidentEvent;
use App\Models\Incident\IncidentEvidence;
use App\Models\Person\PersonContact;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Library\Otrs\OtrsClient;
use Mockery\CountValidator\Exception;
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
        $incidents = Incident::orderBy('id')->get();
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
        //TODO validate the other fields

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
        $incident->evidences = $incidentEvidences;

        //Eventos
        $event_machines = MachineController::getMachines($request);
        $incidentEvents = array();
        foreach ($event_machines as $machine) {
            $source = $machine['source'];
            $target = $machine['target'];

            $event = new IncidentEvent();
            $event->incident_id = $incident->id;
            $event->source_machine_id = $source->id;
            $event->target_machine_id = $target->id;
            $event->save();
            array_push($incidentEvents, $event);
        }
        $incident->events = $incidentEvents;

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
        $incident->categories = $incidentCategories;

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
        $incident->sensors = $incidentSensors;

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
        $incident->signatures = $incidentSignatures;

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

        return view('incident.show', compact('case'));
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
        $incident->evidences = $incidentEvidences;

        //Eventos
        $event_machines = MachineController::getMachines($request);
        $incidentEvents = array();
        foreach ($event_machines as $machine) {
            $source = $machine['source'];
            $target = $machine['target'];
            $payload = $machine['payload'];

            $event = IncidentEvent::whereIncidentId($incident->id)
                ->whereSourceMachineId($source->id)
                ->whereTargetMachineId($target->id)
                ->first();
            if (!isset($event))
                $event = new IncidentEvent();

            $event->incident_id = $incident->id;
            $event->source_machine_id = $source->id;
            $event->target_machine_id = $target->id;
            $event->payload = $payload;
            $event->save();
            array_push($incidentEvents, $event);
        }
        $incident->events = $incidentEvents;

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
        $incident->categories = $incidentCategories;

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
        $incident->sensors = $incidentSensors;

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
        $incident->signatures = $incidentSignatures;

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
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteEvent($id)
    {
        $incidentEvent = IncidentEvent::whereId($id)->first();

        if ($incidentEvent != null) {
            $incidentEvent->delete();
            return \Response::json(['status' => 0, 'message' => 'Se eliminó correctamente el Evento']);
        } else {
            return \Response::json(['status' => 1, 'message' => 'No se pudo eliminar el Evento']);
        }
    }

    public function test()
    {
        return view('incident.test');
    }
}
