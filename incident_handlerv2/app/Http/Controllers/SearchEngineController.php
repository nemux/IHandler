<?php

namespace App\Http\Controllers;

use App\Models\Incident\Incident;
use Illuminate\Http\Request;

class SearchEngineController extends Controller
{
    public function incident()
    {
        return view('search.incident');
    }

    /**
     * Realiza una búsqueda de Incidentes tipo $serch_type={simple|advanced}
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function incidentSearch(Request $request)
    {
//        \Log::info($request->except('_token'));

        $search_type = $request->get('search_type');

        $query = Incident::select(
            'incident.id',
            'ticket.internal_number',
            'incident.title',
            'user.username',
            \DB::raw('to_char("incident"."detection_time", \'DD/MM/YYYY HH24:MI\') as det_time'),
            'ticket_status.name as status'
        );

        if ($search_type == 'simple') {
            $search_string = trim($request->get('search_string'));

            $query->whereRaw("incident.tsv @@ plainto_tsquery('pg_catalog.spanish','$search_string')");

            try {
                $incidents = $query
                    ->leftJoin('ticket', 'ticket.incident_id', '=', 'incident.id')
                    ->leftJoin('ticket_status', 'ticket_status.id', '=', 'ticket.ticket_status_id')
                    ->leftJoin('user', 'user.id', '=', 'incident.user_id')
                    ->limit(1000)
                    ->get();

            } catch (\Exception $e) {
                return \Response::json(['err_code' => $e->getCode(), 'err_message' => $e->getMessage()]);
            }

            return \Response::json(['request' => $search_string, 'items' => $incidents]);

        } else if ($search_type == 'advanced') {

        } else {
            return \Response::json(['err_code' => 1, 'err_message' => 'Tipo de búsqueda incorrecta [search_type={simple|advanced}]']);
        }
    }

    private function escapeChars($string)
    {
        $patrones = array();
        $patrones[0] = '/\?/';
        $patrones[1] = '/%/';
        $patrones[2] = '/_/';

        $sustituciones = array();
        $sustituciones[0] = '\\?';
        $sustituciones[1] = '\\%';
        $sustituciones[2] = '\\_';

        $replaced = preg_replace($patrones, $sustituciones, $string);
        \Log::info($string . ":" . $replaced);

        return $replaced;
    }
}
