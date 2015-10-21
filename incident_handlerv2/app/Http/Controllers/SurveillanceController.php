<?php

namespace App\Http\Controllers;

use App\Models\Criticity;
use App\Models\Customer;
use App\Models\Evidence;
use App\Models\PersonContact;
use App\Models\SurveillanceCase;
use App\Models\SurveillanceCaseEvidence;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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

        \Mail::send('email.surveillance', ['case' => $surv], function ($mail) {
            // TODO define a qué correo se enviarán los casos recién creados de cibervigilancia
            //Temporalmente se envia al correo de cibervigilancia a quien crea el caso

            $mailTo = PersonContact::compareEmail(\Auth::user()->person->contact->email);

            \Log::info($mailTo);

            $mail->to($mailTo, \Auth::user()->person->fullName())->subject('[GCS-IH][CV] Nuevo caso de Cibervigilancia');
        });

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
     * Probando cómo encontrar tags con una URL
     */
    private function testSearchImages()
    {
        $description = '<div id="lipsum">
<p><img alt="" src="http://localhost:8080/evidences/2015/10/20/3bdba9ad125e74e1e71b149baa7eb007.jpg" style="height:266px; width:500px" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sit amet mi in nisi facilisis consectetur. Fusce fermentum sollicitudin urna, eget viverra dolor porttitor id. Fusce fringilla diam sed commodo convallis. Nulla congue interdum ultricies. Curabitur pellentesque luctus elementum. Aenean mauris tellus, luctus vitae eros ac, viverra sagittis erat. Mauris suscipit ut felis suscipit maximus. Nullam semper pretium felis sit amet accumsan. Pellentesque malesuada libero eu tristique convallis. Nam eros enim, semper egestas pretium eu, condimentum vitae mauris. Quisque sodales efficitur lorem id aliquet. Morbi at ultrices est. Pellentesque ac diam venenatis, congue arcu ut, finibus metus.</p>
<p><img alt="" src="/evidences/2015/10/20/3bdba9ad125e74e1e71b149baa7eb007.jpg" style="height:266px; width:500px" /></p>
<p>Pellentesque hendrerit finibus arcu ac faucibus. In semper velit ac libero tristique tempus. Aliquam rhoncus fringilla sapien, vitae scelerisque est iaculis tempor. Aliquam ullamcorper magna non est faucibus luctus. Ut varius arcu et blandit congue. Etiam a felis varius, gravida felis id, placerat lorem. Etiam nec nulla at sapien tempor pretium vel vitae purus. Nunc condimentum vulputate porta. Aenean malesuada gravida erat eu molestie. Nulla nec pulvinar augue. Quisque et consectetur urna, nec tincidunt enim. Morbi semper, nisi et convallis iaculis, lacus nibh interdum nunc, et feugiat ex ligula eleifend lorem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc in sem mollis, ornare nisl et, luctus lectus.</p>
<p><img alt="" src="http://localhost:8080/evidences/2015/10/20/3bdba9ad125e74e1e71b149baa7eb007.jpg" style="height:266px; width:500px" /></p>
<p>Integer condimentum aliquet turpis. Pellentesque ut rhoncus dolor. Nunc bibendum convallis elit eget facilisis. In luctus risus sem, a vehicula ante blandit quis. Morbi tempor interdum lorem ac egestas. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas id elit aliquet, tempus nisl ac, rutrum tellus. Nam scelerisque, dolor vel tincidunt commodo, nulla nunc sagittis neque, at tempus tortor nulla et ipsum. Nunc nec semper sem. Vivamus finibus vestibulum erat id auctor. Duis vehicula porta mauris sed sollicitudin. Maecenas vulputate, orci at pharetra convallis, felis mi egestas tortor, eget tempus diam quam vitae nulla. Integer pharetra at lectus id tempus. Donec non ante laoreet, finibus lorem nec, bibendum nunc. Phasellus leo diam, mollis eget lacinia ut, congue non est.</p>
<p>Proin ac eros sed dui laoreet ornare. Vivamus tortor diam, eleifend sit amet odio semper, feugiat consectetur justo. Aliquam consequat, nunc vitae semper convallis, felis massa malesuada leo, quis euismod est metus quis lorem. In et sodales diam, eget molestie risus. Morbi id urna nunc. Suspendisse in nulla id nulla mollis gravida. Vestibulum imperdiet tellus metus, id tempus turpis lacinia eget. Morbi placerat mollis diam, a pulvinar augue bibendum a. Mauris feugiat luctus nibh, vitae luctus augue tempus eget. Nullam viverra lobortis diam. Donec vel nunc vitae libero porta tristique. Nulla sed nunc vestibulum, pellentesque neque ut, bibendum velit. Phasellus ligula ante, auctor vitae efficitur vitae, laoreet sit amet arcu.</p>
<p>Duis porta at eros a congue. Suspendisse porttitor sodales sapien, ac placerat lectus porta a. Donec est erat, finibus a finibus vel, pretium in ligula. Ut justo elit, semper eu justo ac, pellentesque ullamcorper mauris. Maecenas nisi nulla, commodo non lacus ac, varius pharetra justo. Vestibulum a aliquet lacus. Duis commodo, nisi eget molestie bibendum, tortor lorem dictum tellus, id sodales ipsum lectus sit amet massa. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed dapibus mi eu nunc pharetra, eget luctus libero luctus. In vitae sem quis odio rutrum vestibulum bibendum et augue. Nunc lobortis augue sit amet mi tincidunt consectetur. Aliquam fringilla eget risus at porta. Integer suscipit eleifend orci ut auctor. Fusce pulvinar odio sollicitudin eros ultricies, eu condimentum ipsum aliquam.</p>
<p><img alt="" src="/evidences/2015/10/20/3bdba9ad125e74e1e71b149baa7eb007.jpg" style="height:266px; width:500px" /></p>
</div>';

        $pattern = '/([https*:\/\/)([\S]*:*[\d]*]*)(\/evidences\/)([\d]*\/[\d]*\/[\d]*\/)([\w]+.[\w]+)/i';
        preg_match_all($pattern, $description, $imgs);

        \Log::info($imgs);
    }
}
