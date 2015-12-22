<?php

namespace App\Models\Incident;

use App\Models\BaseModel;
use App\Models\Catalog\AttackSignature;
use Illuminate\Database\Eloquent\SoftDeletes;


class IncidentAttackSignature extends BaseModel
{
    use SoftDeletes;

    protected $table = 'incident_attack_signature';

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

    public function signature()
    {
        return $this->belongsTo(AttackSignature::class, 'attack_signature_id');
    }
}
