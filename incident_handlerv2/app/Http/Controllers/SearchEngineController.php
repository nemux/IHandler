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

        $query = Incident::select('incident.id',
            'ticket.internal_number',
            'incident.title',
            'user.username',
            'incident.detection_time',
            'ticket_status.name as status');

        if ($search_type == 'simple') {
            $search_string = trim($request->get('search_string'));

            $stringFields = [];
            array_push($stringFields, 'incident.description');
            array_push($stringFields, 'incident.recommendation');
            array_push($stringFields, 'incident.reference');

            foreach ($stringFields as $index => $field) {
                if ($index == 0)
                    $query->where('incident.title', 'like', "%$search_string%");
                $query->orWhere($field, 'like', "%$search_string%");
            }

            $incidents = $query
                ->leftJoin('ticket', 'ticket.incident_id', '=', 'incident.id')
                ->leftJoin('ticket_status', 'ticket_status.id', '=', 'ticket.ticket_status_id')
                ->leftJoin('user', 'user.id', '=', 'incident.user_id')
                ->get();

            return \Response::json(['request' => $search_string, 'items' => $incidents]);

        } else if ($search_type == 'advanced') {

        } else {
            return \Response::json(['err_code' => 1, 'err_message' => 'Tipo de búsqueda incorrecta [search_type={simple|advanced}]']);
        }
    }
}
