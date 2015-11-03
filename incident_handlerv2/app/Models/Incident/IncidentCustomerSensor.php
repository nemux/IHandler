<?php

namespace App\Models\Incident;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Incident\IncidentCustomerSensor
 *
 * @property integer $id
 * @property integer $incident_id
 * @property integer $customer_sensor_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property integer $user_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentCustomerSensor whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentCustomerSensor whereIncidentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentCustomerSensor whereCustomerSensorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentCustomerSensor whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentCustomerSensor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentCustomerSensor whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentCustomerSensor whereUserId($value)
 */
class IncidentCustomerSensor extends Model
{
    use SoftDeletes;

    protected $table = 'incident_customer_sensor';

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
}
