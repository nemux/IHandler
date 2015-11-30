<?php

namespace App\Http\Controllers;

use App\Models\Customer\Customer;
use App\Models\Incident\Incident;
use App\Models\Surveillance\SurveillanceCase;
use Illuminate\Http\Request;

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

    /**
     * Muestra una vista genéérica para ensamblar consultas para estadísticas
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('stats.index');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function customer()
    {
        return view('stats.customer');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function customerIpList()
    {
        return view('stats.ip');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function customerIpListPost(Request $request)
    {
        \Log::info($request->except('_token'));

        $customer_id = $request->get('customer_id');
        $from_date = date('Y-m-d 00:00:00', strtotime(str_replace('/', '-', $request->get('from_date'))));
        $to_date = date('Y-m-d 23:59:59', strtotime(str_replace('/', '-', $request->get('to_date'))));
        $side = $request->get('side');
        $top = $request->get('top');
        $blacklist = $request->get('blacklist');

        $query = Incident::select(\DB::raw('asset.ipv4 as ip, count(asset.ipv4) as count'))
            ->leftJoin('incident_event', 'incident_event.incident_id', '=', 'incident.id');

        if ($side == 'source')
            $query->leftJoin('machine', 'machine.id', '=', 'incident_event.source_machine_id');
        else if ($side == 'target')
            $query->leftJoin('machine', 'machine.id', '=', 'incident_event.target_machine_id');

        $query->leftJoin('asset', 'asset.id', '=', 'machine.asset_id');

        if ($customer_id != '')
            $query->where('incident.customer_id', '=', $customer_id);

        $query->whereBetween('incident.detection_time', [$from_date, $to_date])
            ->where('machine.deleted_at', '=', null)
            ->where('incident_event.deleted_at', '=', null)
            ->where('asset.ipv4', '!=', '')
            ->groupBy('asset.ipv4')
            ->orderBy('count', 'desc')
            ->limit($top);

        if ($blacklist == 'true') {
            $query->where('machine.blacklist', '=', 1);
        } else {
            $query->where('machine.blacklist', '=', 0);
        }

        $incidents = $query->get();

        return \Response::json($incidents);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function customerIncidents(Request $request)
    {
//        \Log::info($request->except('_token'));

        $customer_id = $request->get('customer_id');
        $sensors = $request->get('sensors');
        $from_date = date('Y-m-d 00:00:00', strtotime(str_replace('/', '-', $request->get('from_date'))));
        $to_date = date('Y-m-d 23:59:59', strtotime(str_replace('/', '-', $request->get('to_date'))));
        $customer_separated = $request->get('customer_separated');
        $sensor_separated = $request->get('sensor_separated');

        $query = Incident::select(\DB::raw('date(detection_time) as date,count(detection_time)'))
            ->whereBetween('detection_time', [$from_date, $to_date])
            ->groupBy(\DB::raw('date(detection_time)'))
            ->orderBy(\DB::raw('date(detection_time)'));

        if ($customer_id != '') {
            $query->where('incident.customer_id', '=', $customer_id);
            if ($sensors != '') {
                $query->leftJoin('incident_customer_sensor', 'incident_customer_sensor.incident_id', '=', 'incident.id')
                    ->whereIn('incident_customer_sensor.customer_sensor_id', $sensors);
                if ($sensor_separated == 'true') {
                    $incidents = $query->select(\DB::raw('date(detection_time) as date, count(detection_time), customer_sensor.name as sensor'))
                        ->leftJoin('customer_sensor', 'customer_sensor.id', '=', 'incident_customer_sensor.customer_sensor_id')
                        ->groupBy('customer_sensor.name')
                        ->get();

                    $response = $this->arrayToDatasource($incidents, 'sensor', 'date');

                    return \Response::json($response);
                }
            }
        }

        if ($customer_separated == 'true') {
            $incidents = $query->select(\DB::raw('date(detection_time) as date, count(detection_time), customer.otrs_customer_id as customer'))
                ->leftJoin('customer', 'customer.id', '=', 'incident.customer_id')
                ->groupBy('customer.otrs_customer_id')
                ->get();

            $response = $this->arrayToDatasource($incidents, 'customer', 'date');

            return \Response::json($response);
        } else if ($customer_id != '' && $sensors == '' && $sensor_separated == 'true') {
            $incidents = $query->select(\DB::raw('date(detection_time) as date, count(detection_time), customer_sensor.name as sensor'))
                ->leftJoin('incident_customer_sensor', 'incident_customer_sensor.incident_id', '=', 'incident.id')
                ->leftJoin('customer_sensor', 'customer_sensor.id', '=', 'incident_customer_sensor.customer_sensor_id')
                ->groupBy('customer_sensor.name')
                ->get();

            $response = $this->arrayToDatasource($incidents, 'sensor', 'date');

            return \Response::json($response);
        } else {
            $response = $query->get();

            return \Response::json($response);
        }
    }

    /**
     * Convierte un set de datos en un objeto json agrupado por el campo $field
     *
     * @param $data
     * @param $groupField
     * @return array
     */
    private function arrayToDatasource($data, $groupField, $label)
    {
        $response = [];
        foreach ($data as &$element) {
            $item = [];
            foreach ($response as &$r) {
                if (isset($r['name']) && $r['name'] == $element[$groupField]) {
                    $item = $r;
                    array_push($r['data'], [$label => $element[$label], 'count' => $element['count']]);
                }
            }

            if ($item == null) {
                $item['name'] = $element[$groupField];
                $item['data'] = [];

                array_push($item['data'], [$label => $element[$label], 'count' => $element['count']]);
                array_push($response, $item);
            }
        }

        return $response;
    }

    public
    function listRoutes()
    {
    }

    /**
     * Devuelve una respuesta Json con una lista con
     * la cuenta de incidentes por día, por cliente, de los últimos {$days} días
     *
     * @param $days
     * @return \Illuminate\Http\JsonResponse
     */
    public
    function incidentsCustomer($days)
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
    public
    function incidentsCricity($days)
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
    public
    function incidentsFlow($days)
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
    public
    function incidentsCategory($days)
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
    public
    function incidentsType($days)
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
    public
    function lastIncidents($take)
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
    public
    function lastSurveillances($take)
    {
        if (isset($take) && is_numeric($take)) {
            $surveillances = SurveillanceCase::orderBy('id', 'desc')->take($take)->get(['id', 'title', 'criticity_id']);
            return \Response::json($surveillances);
        } else {
            return \Response::json($this->BAD_REQUEST_PARAMS);
        }
    }
}
