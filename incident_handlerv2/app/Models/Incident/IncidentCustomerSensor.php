<?php

namespace App\Models\Incident;

use App\Models\BaseModel;
use App\Models\Customer\CustomerSensor;
use Illuminate\Database\Eloquent\SoftDeletes;


class IncidentCustomerSensor extends BaseModel
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
        else
            $this->user_id = 1;

        parent::__construct($attributes);
    }

    public function sensor()
    {
        return $this->belongsTo(CustomerSensor::class, 'customer_sensor_id');
    }
}
