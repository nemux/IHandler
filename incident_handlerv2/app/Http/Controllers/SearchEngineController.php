<?php

namespace App\Http\Controllers;

use App\Models\Incident\Incident;
use Carbon\Carbon;
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
        $search_type = $request->get('search_type');

        if ($search_type == '') {
            return \Response::json(['err_code' => 1, 'err_message' => 'No está definido el tipo de búsqueda']);
        }

        $empty = false;
        foreach ($request->except('_token') as $index => $input) {
            if ($index != 'search_type') {
                if (is_array($input) && sizeof($input) == 0) {
                    $empty = true;
                } else {
                    if (empty($input)) {
                        $empty = true;
                    } else {
                        $empty = false;
                        break;
                    }
                }
            }
        }

        if ($empty) {
//            \Log::info('exit for empty');
            return \Response::json(['err_code' => 1, 'err_message' => 'Debe llenar al menos uno de los campos del formulario']);
        }

        $query = Incident::select(
            'incident.id',
            'ticket.internal_number',
            'incident.title',
            'user.username',
            \DB::raw('to_char("incident"."detection_time", \'DD/MM/YYYY HH24:MI \')||\'' . date_default_timezone_get() . '\' as det_time'), //TODO CST (timezone) no debería ir aquí
            'ticket_status.name as status',
            'criticity.name as criticity'
        )->leftJoin('ticket', 'ticket.incident_id', '=', 'incident.id')
            ->leftJoin('ticket_status', 'ticket_status.id', '=', 'ticket.ticket_status_id')
            ->leftJoin('user', 'user.id', '=', 'incident.user_id')
            ->leftJoin('criticity', 'criticity.id', '=', 'incident.criticity_id')
            ->with('signatures.signature')
            ->with('sensors.sensor');

        if ($search_type == 'simple') {
            $search_string = trim($request->get('search_string'));

            if ($search_string != '')
                $query->whereRaw("incident.tsv @@ plainto_tsquery('pg_catalog.spanish','$search_string')");

            try {
                $incidents = $query->get();
            } catch (\Exception $e) {
                return \Response::json(['err_code' => 1, 'err_message' => $e->getMessage()]);
            }

            return \Response::json(['request' => $search_string, 'items' => $incidents]);

        } else if ($search_type == 'advanced') {

            $search_string = $request->get('search_string_advanced');

            if ($request->get('from_detection') != '' && $request->get('to_detection') != '') {
                $from_detection = date('Y-m-d 00:00:00', strtotime(str_replace('/', '-', $request->get('from_detection'))));
                $to_detection = date('Y-m-d 23:59:59', strtotime(str_replace('/', '-', $request->get('to_detection'))));
                $query->whereBetween('incident.detection_time', [$from_detection, $to_detection]);
            }

            if ($request->get('from_occurrence') && $request->get('to_occurrence')) {
                $from_occurrence = date('Y-m-d 00:00:00', strtotime(str_replace('/', '-', $request->get('from_occurrence'))));
                $to_occurrence = date('Y-m-d 23:59:59', strtotime(str_replace('/', '-', $request->get('to_occurrence'))));
                $query->whereBetween('incident.occurrence_time', [$from_occurrence, $to_occurrence]);
            }

            $users = $request->get('user');

            $customers = $request->get('customer');
            $sensors = $request->get('sensor');
            $criticities = $request->get('criticity');

            $categories = $request->get('category');
            $signatures = $request->get('signature');

            $flows = $request->get('flow');
            $attacktypes = $request->get('attacktype');

            //TODO usar OR y AND en las consultas (Definir estas opciones en el formulario)
            if ($customers)
                $query->whereIn('incident.customer_id', $customers);
            if ($criticities)
                $query->whereIn('incident.criticity_id', $criticities);
            if ($flows)
                $query->whereIn('incident.attack_flow_id', $flows);
            if ($attacktypes)
                $query->whereIn('incident.attack_type_id', $attacktypes);
            if ($search_string != '')
                $query->whereRaw("incident.tsv @@ plainto_tsquery('pg_catalog.spanish','$search_string')");

            if ($users)
                $query->whereIn('incident.user_id', $users);

            if ($categories) {
                $query->leftJoin('incident_attack_category as iac', 'iac.incident_id', '=', 'incident.id');
                $query->whereIn('iac.attack_category_id', $categories);
            }

            if ($sensors) {
                $query->leftJoin('incident_customer_sensor as ics', 'ics.incident_id', '=', 'incident.id');
                $query->whereIn('ics.customer_sensor_id', $sensors);
            }

            if ($signatures) {
                $query->whereIn('ias.attack_signature_id', $signatures);
            }

            try {
                $incidents = $query->get();
            } catch (\Exception $e) {
                return \Response::json(['err_code' => 1, 'err_message' => $e->getMessage()]);
            }

            return \Response::json(['items' => $incidents]);
        } else {
            return \Response::json(['err_code' => 1, 'err_message' => 'Tipo de búsqueda incorrecta [search_type={simple|advanced}]']);
        }
    }
}
