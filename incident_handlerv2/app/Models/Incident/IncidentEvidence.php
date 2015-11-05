<?php

namespace App\Models\Incident;

use App\Models\Evidence\Evidence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Incident\IncidentEvidence
 *
 * @property integer $id
 * @property integer $incident_id
 * @property integer $evidence_id
 * @property string $note
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property integer $user_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentEvidence whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentEvidence whereIncidentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentEvidence whereEvidenceId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentEvidence whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentEvidence whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentEvidence whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentEvidence whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentEvidence whereUserId($value)
 */
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
