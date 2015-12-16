<?php

namespace App\Models\Incident;

use App\Models\BaseModel;
use App\Models\Evidence\Evidence;
use Illuminate\Database\Eloquent\SoftDeletes;


class IncidentEvidence extends BaseModel
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
        else
            $this->user_id = 1;

        parent::__construct($attributes);
    }

    /**
     * Regresa la evidencia que corresponde a la relación
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function evidence()
    {
        return $this->belongsTo(Evidence::class, 'evidence_id');
    }

    /**
     * Regresa el incidente que coresponde a la relación
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function incident()
    {
        return $this->belongsTo(Incident::class, 'incident_id');
    }
}
