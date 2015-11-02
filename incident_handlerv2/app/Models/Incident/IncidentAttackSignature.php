<?php

namespace App\Models\Incident;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Incident\IncidentAttackSignature
 *
 * @property integer $id
 * @property integer $incident_id
 * @property integer $attack_signature_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property integer $user_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentAttackSignature whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentAttackSignature whereIncidentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentAttackSignature whereAttackSignatureId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentAttackSignature whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentAttackSignature whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentAttackSignature whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentAttackSignature whereUserId($value)
 */
class IncidentAttackSignature extends Model
{
    use SoftDeletes;

    protected $table = 'incident_attack_signature';
}
