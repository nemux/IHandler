<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Incident\Incident;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function incidentReport($report_type)
    {
        switch ($report_type) {
            case 'date':
            case 'handler':
            case 'category':
            case 'criticity':
            case 'status':
            case 'ip':
            case 'csv':
            case 'list':
                return view('report.incident')->withType($report_type);
                break;
            default:
                abort(404);
        }
    }

    public function incidentReportPost(Request $request, $report_type)
    {
        \Log::info($request->except('_token'));

        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');

        if ($from_date == '' || $to_date == '') {
            return redirect()->route('report.incident', $report_type)->withErrors(['Los campos de fecha no pueden estar vacíos']);
        }

        $from_date = date('Y-m-d 00:00:00', strtotime(str_replace('/', '-', $request->get('from_date'))));
        $to_date = date('Y-m-d 23:59:59', strtotime(str_replace('/', '-', $request->get('to_date'))));

//        switch ($report_type) {
//            case 'date':
//                break;
//            case 'handler':
//                break;
//            case 'category':
//                break;
//            case 'criticity':
//                break;
//            case 'status':
//                break;
//            case 'ip':
//                break;
//            case 'csv':
//                break;
//            case 'list':
//                break;
//            default:
//                abort(404);
//        }


        $query = Incident::whereBetween('incident.detection_time', [$from_date, $to_date]);

        $incidents = $query->get();
        $incidents_html = '<html><head><meta charset=\'utf-8\'></head><body>';
        foreach ($incidents as $index => &$i) {
            if ($index != 0) {
                $incidents_html .= '<br/>';
            }
            $incidents_html .= view('incident._preview', ['case' => $i])->render();
        }
        $incidents_html .= '</body></html>';


        $headers = array(
            "Content-Type" => "application/vnd.ms-word;charset=utf-8",
            "Content-Disposition" => "attachment;Filename=Reporte_incidentes.doc"
        );

        return \Response::make($incidents_html, 200, $headers);
    }
}
