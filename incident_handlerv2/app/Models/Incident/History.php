<?php

namespace App\Models\Incident;

use App\Models\BaseModel;
use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\SoftDeletes;
use Psy\Util\Json;

class History extends BaseModel
{
    use SoftDeletes;

    protected $table = 'incident_history';

    /**
     * Almacena un histórico de un incidente
     *
     * @param Incident $i
     */
    public static function store(Incident $i)
    {
        $h = new History();

        $h->incident_id = $i->id;
        $h->user_id = \Auth::user()->id;
        $h->title = $i->title;
        $h->categories = $h->generateCategories($i->categories);
        $h->detection_time = $i->detection_time;
        $h->occurrence_time = $i->occurrence_time;
        $h->attack_flow = $i->flow->name;
        $h->attack_type = $i->type->name;
        $h->criticity = $i->criticity->name;
        $h->impact = $i->impact;
        $h->risk = $i->risk;
        $h->customer_name = $i->customer->name;
        $h->sensors = $h->generateSensors($i->sensors);
        $h->signatures = $h->generateSignatures($i->signatures);
        $h->events = $h->generateEvents($i->events);
        $h->description = $i->description;
        $h->recommendation = $i->recommendation;
        $h->reference = $i->reference;
        $h->evidences = $h->generateEvidences($i->allEvidences);

        $h->save();
    }

    private function generateCategories($categories)
    {
        $array = array();
        foreach ($categories as $item) {
            array_push($array, $item->category->name);
        }
        return Json::encode($array);
    }

    private function generateSensors($sensors)
    {
        $array = array();
        foreach ($sensors as $item) {
            array_push($array, $item->sensor->name);
        }
        return Json::encode($array);
    }

    private function generateEvents($events)
    {
        $array = array();
        foreach ($events as $item) {
            array_push($array, ['source' => $item->source, 'target' => $item->target]);
        }
        return Json::encode($array);
    }

    private function generateEvidences($evidences)
    {
        $array = array();
        foreach ($evidences as $item) {
            array_push($array, $item->evidence->evidence);
        }
        return Json::encode($array);
    }

    private function generateSignatures($signatures)
    {
        $array = array();
        foreach ($signatures as $item) {
            array_push($array, $item->signature->name);
        }
        return Json::encode($array);
    }
}
