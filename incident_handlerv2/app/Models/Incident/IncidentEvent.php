<?php

namespace App\Models\Incident;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


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
