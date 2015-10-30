<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\SurveillanceCaseEvidence
 *
 * @property integer $surveillance_case_id
 * @property integer $evidence_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveillanceCaseEvidence whereSurveillanceCaseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveillanceCaseEvidence whereEvidenceId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveillanceCaseEvidence whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveillanceCaseEvidence whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveillanceCaseEvidence whereDeletedAt($value)
 * @property integer $id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveillanceCaseEvidence whereId($value)
 * @property-read Evidence $evidence
 * @property string $note
 * @property integer $user_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveillanceCaseEvidence whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveillanceCaseEvidence whereUserId($value)
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
