<?php

namespace App\Models\Evidence;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

/**
 * App\Models\Evidence\EvidenceType
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence\EvidenceType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence\EvidenceType whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence\EvidenceType whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence\EvidenceType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence\EvidenceType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence\EvidenceType whereDeletedAt($value)
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
