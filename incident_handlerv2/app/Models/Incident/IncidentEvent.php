<?php

namespace App\Models\Incident;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Incident\IncidentEvent
 *
 * @property integer $id
 * @property integer $incident_id
 * @property integer $source_machine_id
 * @property integer $target_machine_id
 * @property string $payload
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property integer $user_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentEvent whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentEvent whereIncidentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentEvent whereSourceMachineId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentEvent whereTargetMachineId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentEvent wherePayload($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentEvent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentEvent whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentEvent whereUserId($value)
 * @property-read Machine $source
 * @property-read Machine $target
 */
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
}
