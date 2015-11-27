<?php

namespace App\Http\Controllers;

use App\Models\Incident\Incident;
use App\Models\Incident\IncidentEvent;
use App\Models\Incident\Machine;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class IncidentEventController extends Controller
{
    /**
     * Obtiene de un $request todos los elementos que estén relacionados con evidencia.
     * @param Request $request
     * @return array
     */
    public static function getMachines(Request $request)
    {
        $values = $request->all();
        $machines = array();

        //Para todos los campos pasados a través del request
        foreach ($values as $field => $value) {
            //Si comienza por 'event_'
            if (strpos($field, 'event_') !== false) {
                //Obtenemos el valor en string
                $var = $request->get($field);
                //Parseamos el Json a un array
                $var = json_decode($var, true);

                //Valida que sea una relación 1-source 1-target
                if (isset($var['source']) && isset($var['target'])) {

                    $source = Machine::getMachine($var['source']);
                    $source->save();

                    $target = Machine::getMachine($var['target']);
                    $target->save();

                    $payload = $var['payload'];
                    array_push($machines, ['source' => $source, 'target' => $target, 'payload' => $payload, 'event_relation' => '11']);
                } else if (isset($var['source']) && isset($var['targets'])) {

                    $source = Machine::getMachine($var['source']);
                    $source->save();

                    foreach ($var['targets'] as $var_target) {
                        $target = Machine::getMachine($var_target['target']);
                        $target->save();
                        $payload = $var_target['payload'];
                        array_push($machines, ['source' => $source, 'target' => $target, 'payload' => $payload, 'event_relation' => '1n']);
                    }
                } else if (isset($var['sources']) && isset($var['target'])) {

                    $target = Machine::getMachine($var['target']);
                    $target->save();

                    foreach ($var['sources'] as $var_target) {
                        $source = Machine::getMachine($var_target['source']);
                        $source->save();
                        $payload = $var_target['payload'];
                        array_push($machines, ['source' => $source, 'target' => $target, 'payload' => $payload, 'event_relation' => 'n1']);
                    }
                }
            }
        }

        return $machines;
    }
}
