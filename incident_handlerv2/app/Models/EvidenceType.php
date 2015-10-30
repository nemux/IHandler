<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\EvidenceType
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EvidenceType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EvidenceType whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EvidenceType whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EvidenceType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EvidenceType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EvidenceType whereDeletedAt($value)
 */
class EvidenceType extends Model
{
    use SoftDeletes;
    /**
     * Permite borrado lógico
     * @var bool
     */
    protected $softDelete = true;
    protected $table = 'evidence_type';
}
