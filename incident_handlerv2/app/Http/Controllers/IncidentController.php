<?php

namespace App\Http\Controllers;

use App\Models\Incident\Incident;
use App\Models\Incident\IncidentAttackCategory;
use App\Models\Incident\IncidentAttackSignature;
use App\Models\Incident\IncidentCustomerSensor;
use App\Models\Incident\IncidentEvent;
use App\Models\Incident\IncidentEvidence;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Library\Otrs\OtrsClient;

class IncidentController extends Controller
{
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
        //TODO Validate request fields?

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

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

    public function email($id)
    {

    }
}
