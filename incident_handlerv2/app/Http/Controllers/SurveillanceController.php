<?php

namespace App\Http\Controllers;

use App\Models\Catalog\Criticity;
use App\Models\Customer\Customer;
use App\Models\Evidence\Evidence;
use App\Models\Person\PersonContact;
use App\Models\Surveillance\SurveillanceCase;
use App\Models\Surveillance\SurveillanceCaseEvidence;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Library\InlineCss;

class SurveillanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cases = SurveillanceCase::all();

        return view('surveillance.index', compact('cases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all(['name', 'id']);
        $criticities = Criticity::all(['name', 'id']);

        return view('surveillance.create', compact('customers', 'criticities'))->withPostroute('file.upload.surveillance');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Agregar todos los archivos de evidencia
        $evidences = $this->getEvidences($request);

        \Session::flash('surv_evidences', $evidences);

        SurveillanceCase::validateCreate($request, $this);

        $surv = new SurveillanceCase();
        $surv->customer_id = $request->get('customer_id');
        $surv->criticity_id = $request->get('criticity_id');
        $surv->title = $request->get('title');
        $surv->description = $request->get('description');
        $surv->recommendation = $request->get('recommendation');
        $surv->save();

        foreach ($evidences as $evidence) {
            $surv_evidence = new SurveillanceCaseEvidence();
            $surv_evidence->surveillance_case_id = $surv->id;
            $surv_evidence->evidence_id = $evidence->id;
            $surv_evidence->note = 'SN';
            $surv_evidence->save();
        }

        $this->sendEmail($surv);

        return redirect()->route('surveillance.index')->withMessage('Nuevo caso de Cibervigilancia creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $case = SurveillanceCase::whereId($id)->first();

        return view('surveillance.show', compact('case'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $case = SurveillanceCase::whereId($id)->first();
        $customers = Customer::all(['name', 'id']);
        $criticities = Criticity::all(['name', 'id']);

        return view('surveillance.edit', compact('case', 'customers', 'criticities'))->withPostroute('file.upload.surveillance');
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
        //Agregar todos los archivos de evidencia
        $evidences = $this->getEvidences($request);

        //Almacena en variables de sesión las evidencias, por si ocurriera un error en la actualización
        \Session::flash('surv_evidences', $evidences);

        SurveillanceCase::validateUpdate($request, $this);

        $surv = SurveillanceCase::whereId($id)->first();
        $surv->customer_id = $request->get('customer_id');
        $surv->criticity_id = $request->get('criticity_id');
        $surv->title = $request->get('title');
        $surv->description = $request->get('description');
        $surv->recommendation = $request->get('recommendation');
        $surv->save();

        foreach ($evidences as $evidence) {
            $surv_evidence = new SurveillanceCaseEvidence();
            $surv_evidence->surveillance_case_id = $surv->id;
            $surv_evidence->evidence_id = $evidence->id;
            $surv_evidence->note = 'SN';
            $surv_evidence->save();
        }

        return redirect()->route('surveillance.index')->withMessage('Se actualizó el caso ' . $surv->title);
    }

//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int $id
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy($id)
//    {
//        //
//    }

    /**
     * Obtiene de un $request todos los elementos que estén relacionados con evidencia.
     * @param Request $request
     * @return array
     */
    private function getEvidences(Request $request)
    {
        $values = $request->all();
        $evidences = array();
        foreach ($values as $field => $value) {
            $pos = strpos($field, 'evidence_');
            if ($pos !== false) {
                $evidence = Evidence::whereId($value)->first();
                array_push($evidences, $evidence);
            }
        }

        return $evidences;
    }

    /**
     * Genera el PDF con la vista correspondiente
     * @param SurveillanceCase $surv
     * @return \PDF
     */
    private function generatePdf(SurveillanceCase $surv)
    {
        $html = view('pdf.surveillance', ['case' => $surv, 'isPdf' => true])->render();
        $pdf = \PDF::loadHTML($html);
        return $pdf;
    }

    /**
     * Devuelve al navegador el stream del PDF
     * @param $id
     * @return mixed
     */
    public function getPdf($id, $download = false)
    {
        $surv = SurveillanceCase::whereId($id)->first();
        $pdf = $this->generatePdf($surv);
        $docName = $surv->title . '.pdf';

        if ($download) {
            return $pdf->download($docName);
        } else {
            return $pdf->stream($docName);
        }
    }

    /**
     * Llamada por GET para enviar correo del caso
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function email($id)
    {
        $surv = SurveillanceCase::whereId($id)->first();
        $this->sendEmail($surv);
        return redirect()->route('surveillance.show', $id)->withMessage('Se envió el correo electrónico del caso ' . $surv->title);
    }

    /**
     * Envia un correo electronico, adjuntando en PDF el reporte del caso.
     * @param SurveillanceCase $surv
     */
    public function sendEmail(SurveillanceCase $surv)
    {
        $pdf = $this->generatePdf($surv);

        \Mail::send('email.surveillance', compact('surv'), function ($message) use ($pdf, $surv) {
            $mailTo = PersonContact::compareEmail(\Auth::user()->person->contact->email);

            $message->attachData($pdf->output(), $surv->title . '.pdf');
            $message->to($mailTo, \Auth::user()->person->fullName());
            $message->subject('[GCS-IH][CV][' . $surv->customer->name . '] ' . $surv->title);
        });
    }
}
