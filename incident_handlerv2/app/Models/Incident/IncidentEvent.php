<?php

namespace App\Models\Incident;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Monolog\Formatter\LogglyFormatter;
use PhpParser\Node\Expr\Cast\Array_;


class IncidentEvent extends Model
{
    use SoftDeletes;

    protected $table = 'incident_event';

    /**
     * Constructor de la clase
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        //Almacena de forma automática el ID del usuario que lo está invocando.

        if (\Auth::user() !== null)
            $this->user_id = \Auth::user()->id;
        else
            $this->user_id = 1;

        parent::__construct($attributes);
    }

    public function source()
    {
        return $this->belongsTo(Machine::class, 'source_machine_id');
    }

    public function target()
    {
        return $this->belongsTo(Machine::class, 'target_machine_id');
    }

    /**
     * Permite ensamblar un arreglo de eventos
     *
     * @param Incident $incident
     * @return array Lista de eventos agrupados si es
     * multiorigen a destino, origen a multidestino u origen-destino
     */
    public static function generateArray(Incident $incident)
    {
        $groupedEvents = array();
        foreach ($incident->events as $event) {
            $source = $event->source;
            $target = $event->target;
            $payload = $event->payload;
            $event_relation = $event->event_relation;

            $event = null;
            if ($event_relation === '11'||$event_relation === 'ol') {
                array_push($groupedEvents, ['type' => '11', 'source' => $source, 'target' => $target, 'payload' => $payload]);
            } else if ($event_relation === '1n') {
                $found = false;
                foreach ($groupedEvents as &$e) {
                    if (isset($e['targets']) && $e['source']->id == $source->id) {
                        array_push($e['targets'], $target);
                        $found = true;
                        break;
                    }
                }

                if (!$found) {
                    array_push($groupedEvents, ['type' => '1n', 'source' => $source, 'targets' => [$target]]);
                }
            } else if ($event_relation === 'n1') {
                $found = false;
                foreach ($groupedEvents as &$e) {
                    if (isset($e['sources']) && $e['target']->id == $target->id) {
                        array_push($e['sources'], $source);
                        $found = true;
                        break;
                    }
                }

                if (!$found) {
                    array_push($groupedEvents, ['type' => 'n1', 'target' => $target, 'sources' => [$source]]);
                }
            }
        }

        return $groupedEvents;
    }
}
