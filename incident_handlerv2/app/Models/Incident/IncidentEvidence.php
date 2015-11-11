<?php

namespace App\Models\Incident;

use App\Models\Evidence\Evidence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class IncidentEvidence extends Model
{
    use  SoftDeletes;

    protected $table = 'incident_evidence';

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

    public function evidence()
    {
        return $this->belongsTo(Evidence::class, 'evidence_id');
    }
}
