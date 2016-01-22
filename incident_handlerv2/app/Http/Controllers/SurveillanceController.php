<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Library\Pdf;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Models\IncidentManager\Catalog\Criticity;
use Models\IncidentManager\Customer\Customer;
use Models\IncidentManager\Person\PersonContact;
use Models\IncidentManager\Surveillance\SurveillanceCase;
use Models\IncidentManager\Surveillance\SurveillanceCaseEvidence;

class SurveillanceController extends Controller
{
    protected $email_subject_prefix = '[GCS-IM][Cibervigilancia]'; //TODO move to .env file

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cases = SurveillanceCase::orderBy('id', 'desc')->paginate(10);

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
        $evidences = EvidenceController::getEvidences($request);

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

//        $this->sendEmail($surv);

        return redirect()
            ->route('surveillance.show', $surv->id)
            ->withMessage('Nuevo caso de Cibervigilancia creado');
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
        $evidences = EvidenceController::getEvidences($request);

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


        return redirect()
            ->route('surveillance.show', $surv->id)
            ->withMessage('Se actualizó el caso ' . $surv->title);
    }

    /**
     * Devuelve al navegador el stream del PDF
     * @param $id
     * @param bool $download
     * @return \PDF
     */
    public function getPdf($id, $download = false)
    {
        $case = SurveillanceCase::whereId($id)->first();
        $pdf = Pdf::generatePdf($case, 'pdf.surveillance');
        $docName = $case->title . '.pdf';
        $docName = preg_replace('/ /', '_', $docName);

        if ($download) {
            return $pdf->download($docName);
        } else {
            return $pdf->stream($docName);
        }
    }

    /**
     * Devuelve al navegador el stream del PDF
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function getDoc($id)
    {
        $case = SurveillanceCase::whereId($id)->first();

        $docName = $case->title . '.docx';
        $docName = preg_replace('/ /', '_', $docName);

        $doc = DocController::generateDoc($case, 'pdf.surveillance');

        $headers = array(
            "Content-Type" => "application/vnd.ms-word;charset=utf-8",
            "Content-Disposition" => "attachment;Filename=$docName"
        );

        return \Response::make($doc, 200, $headers);
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
     *
     * @param SurveillanceCase $surv
     * @param string $extra_info
     */
    public function sendEmail(SurveillanceCase $surv, $extra_info = '')
    {
        \Mail::send('email.surveillance', compact('surv', 'extra_info'), function (Message $message) use ($surv) {
//            Adjuntamos las evidencias cargadas
            foreach ($surv->evidences as $evidence) {
                $file = $evidence->evidence->path . $evidence->evidence->name;
                $name = $evidence->evidence->original_name;

                $message->attachData(\Storage::get($file), $name);
            }

            $pdf = Pdf::generatePdf($surv, 'pdf.surveillance');

            $mailTo = PersonContact::compareEmail($surv->user->person->contact->email);

            $message->attachData($pdf->output(), $surv->title . '.pdf');

            //TODO enviar correo al cliente? Actualmente se envía un reporte manual.
//            $message->to($mailTo, \Auth::user()->person->fullName()); //CustomerMail

            $message->to(env('MAIL_SOC'), env('MAIL_SOC_NAME')); //SocMail

            $message->subject($this->email_subject_prefix . '[' . $surv->customer->otrs_customer_id . '] ' . $surv->title);
        });
    }

    /**
     * Muestra una vista previa del caso de cibervigilancia tal como se creará el documento PDF
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function preview($id)
    {
        $case = SurveillanceCase::whereId($id)->first();
        $isPdf = false;

        return view('pdf.surveillance', compact('case', 'isPdf'));
    }
}
