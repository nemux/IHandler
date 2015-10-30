<?php

namespace App\Models\Surveillance;

use App\Models\Evidence\Evidence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

/**
 * App\Models\Surveillance\SurveillanceCaseEvidence
 *
 * @property integer $id
 * @property integer $surveillance_case_id
 * @property integer $evidence_id
 * @property string $note
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property integer $user_id
 * @property-read Evidence $evidence
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Surveillance\SurveillanceCaseEvidence whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Surveillance\SurveillanceCaseEvidence whereSurveillanceCaseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Surveillance\SurveillanceCaseEvidence whereEvidenceId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Surveillance\SurveillanceCaseEvidence whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Surveillance\SurveillanceCaseEvidence whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Surveillance\SurveillanceCaseEvidence whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Surveillance\SurveillanceCaseEvidence whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Surveillance\SurveillanceCaseEvidence whereUserId($value)
 */
class SurveillanceCaseEvidence extends Model
{
    use SoftDeletes;
    /**
     * Permite borrado lógico
     * @var bool
     */
    protected $softDelete = true;

    /**
     * Table name
     * @var string
     */
    protected $table = 'surveillance_case_evidence';

    /**
     * Cosntructor de la clase
     */
    public function __construct(array $attributes = [])
    {
        //Almacena de forma automática el ID del usuario que lo está invocando.

        if (\Auth::user() !== null)
            $this->user_id = \Auth::user()->id;

        parent::__construct($attributes);
    }

    /**
     * Representa la relación entre un caso y una evidencia
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function evidence()
    {
        return $this->belongsTo(Evidence::class, 'evidence_id');
    }
}
