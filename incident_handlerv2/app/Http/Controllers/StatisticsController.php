<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Customer\Customer;
use App\Models\Incident\Incident;
use App\Models\Surveillance\SurveillanceCase;

/**
 * Esta clase contiene todos los métodos utilizados para devolver objetos Json
 * con información sobre estadísticas sobre incidentes de seguridad y cibervigilancia
 *
 * Class StatisticsController
 * @package App\Http\Controllers
 */
class StatisticsController extends Controller
{
    private $BAD_REQUEST_PARAMS = ['err_code' => '1000', 'message' => 'Los parámetros esperados en la petición no son suficientes o el formato no es correcto'];

    public function listRoutes()
    {
    }

    /**
     * Devuelve una respuesta Json con una lista con
     * la cuenta de incidentes por día, por cliente, de los últimos {$days} días
     *
     * @param $days
     * @return \Illuminate\Http\JsonResponse
     */
    public function incidentsCustomer($days)
    {
        //Si está definida la variable de días y es de tipo numérico
        if (isset($days) && is_numeric($days)) {
            $fromDate = date_sub(new \DateTime(), new \DateInterval("P" . ($days - 1) . "D"));

            $incidents = Incident::where('incident.detection_time', '>=', $fromDate->format('Y-m-d'))
                ->select(\DB::raw('customer_id, count(customer_id) as incidents, to_char(incident.detection_time, \'YYYY-MM-DD\') as date'))
                ->groupBy(['customer_id', 'date'])
                ->orderBy('date', 'asc')
                ->get();

            $dataSource = [];
            foreach ($incidents as $index => &$i) {
                $item = [];
                foreach ($dataSource as &$e) {
                    if ($e['date'] == $i->date) {
                        $item = $e;
                        $e['customer_' . $i->customer_id] = $i->incidents;
                    }
                }

                if ($item == null) {
                    $item['date'] = $i->date;
                    $item['customer_' . $i->customer_id] = $i->incidents;
                    array_push($dataSource, $item);
                }
            }

            return \Response::json($dataSource);
        } else {
            return \Response::json($this->BAD_REQUEST_PARAMS);
        }
    }

    /**
     * Devuelve una respuesta Json con la cantidad de incidentes
     * por criticidad, de los últimos {$days} días.
     *
     * @param $days
     * @return \Illuminate\Http\JsonResponse
     */
    public function incidentsCricity($days)
    {
        if (isset($days) && is_numeric($days)) {
            $fromDate = date_sub(new \DateTime(), new \DateInterval("P" . ($days - 1) . "D"));

            $incidents = Incident::where('incident.detection_time', '>=', $fromDate->format('Y-m-d'))
                ->select(\DB::raw('criticity.name as name, count(*) as incidents'))
                ->leftJoin('criticity', 'criticity.id', '=', 'incident.criticity_id')
                ->groupBy(['criticity.id'])
                ->orderBy('criticity.id', 'asc')
                ->get();

            return \Response::json($incidents);
        } else {
            return \Response::json($this->BAD_REQUEST_PARAMS);
        }
    }

    /**
     * Devuelve una respuesta Json con la cantidad de incidentes
     * por flujo, de los últimos {$days} días.
     *
     * @param $days
     * @return \Illuminate\Http\JsonResponse
     */
    public function incidentsFlow($days)
    {
        if (isset($days) && is_numeric($days)) {
            $fromDate = date_sub(new \DateTime(), new \DateInterval("P" . ($days - 1) . "D"));

            $incidents = Incident::where('incident.detection_time', '>=', $fromDate->format('Y-m-d'))
                ->select(\DB::raw('attack_flow.name as name, count(*) as incidents'))
                ->leftJoin('attack_flow', 'attack_flow.id', '=', 'incident.attack_flow_id')
                ->groupBy(['attack_flow.id'])
                ->orderBy('attack_flow.id', 'asc')
                ->get();

            return \Response::json($incidents);
        } else {
            return \Response::json($this->BAD_REQUEST_PARAMS);
        }
    }


    /**
     * Devuelve una respuesta Json con la cantidad de incidentes
     * por firma, de los últimos {$days} días.
     *
     * @param $days
     * @return \Illuminate\Http\JsonResponse
     */
    public function incidentsCategory($days)
    {
        if (isset($days) && is_numeric($days)) {
            $fromDate = date_sub(new \DateTime(), new \DateInterval("P" . ($days - 1) . "D"));

            $incidents = Incident::where('incident.detection_time', '>=', $fromDate->format('Y-m-d'))
                ->select(\DB::raw('attack_category.name as name, count(*) as incidents'))
                ->leftJoin('incident_attack_category', 'incident_attack_category.incident_id', '=', 'incident.id')
                ->leftJoin('attack_category', 'attack_category.id', '=', 'incident_attack_category.attack_category_id')
                ->groupBy(['attack_category.id'])
                ->orderBy('attack_category.id', 'asc')
                ->get();

            return \Response::json($incidents);
        } else {
            return \Response::json($this->BAD_REQUEST_PARAMS);
        }
    }

    /**
     * Devuelve una respuesta Json con la cantidad de incidentes
     * por flujo, de los últimos {$days} días.
     *
     * @param $days
     * @return \Illuminate\Http\JsonResponse
     */
    public function incidentsType($days)
    {
        if (isset($days) && is_numeric($days)) {
            $fromDate = date_sub(new \DateTime(), new \DateInterval("P" . ($days - 1) . "D"));

            $incidents = Incident::where('incident.detection_time', '>=', $fromDate->format('Y-m-d'))
                ->select(\DB::raw('attack_type.name as name, count(*) as incidents'))
                ->leftJoin('attack_type', 'attack_type.id', '=', 'incident.attack_type_id')
                ->groupBy(['attack_type.id'])
                ->orderBy('attack_type.id', 'asc')
                ->get();

            return \Response::json($incidents);
        } else {
            return \Response::json($this->BAD_REQUEST_PARAMS);
        }
    }

    /**
     * @param $take
     * @return \Illuminate\Http\JsonResponse
     */
    public function lastIncidents($take)
    {
        if (isset($take) && is_numeric($take)) {
            $incidents = Incident::orderBy('id', 'desc')->take($take)->get(['id', 'title', 'criticity_id']);
            return \Response::json($incidents);
        } else {
            return \Response::json($this->BAD_REQUEST_PARAMS);
        }
    }

    /**
     * @param $take
     * @return \Illuminate\Http\JsonResponse
     */
    public function lastSurveillances($take)
    {
        if (isset($take) && is_numeric($take)) {
            $surveillances = SurveillanceCase::orderBy('id', 'desc')->take($take)->get(['id', 'title', 'criticity_id']);
            return \Response::json($surveillances);
        } else {
            return \Response::json($this->BAD_REQUEST_PARAMS);
        }
    }
}
