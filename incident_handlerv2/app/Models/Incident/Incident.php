<?php

namespace App\Models\Incident;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Incident\Incident
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $recommendation
 * @property string $reference
 * @property integer $attack_type_id
 * @property integer $criticity_id
 * @property integer $impact
 * @property integer $risk
 * @property string $detection_time
 * @property string $occurrence_time
 * @property integer $customer_id
 * @property integer $attack_flow_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property integer $user_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Incident whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Incident whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Incident whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Incident whereRecommendation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Incident whereReference($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Incident whereAttackTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Incident whereCriticityId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Incident whereImpact($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Incident whereRisk($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Incident whereDetectionTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Incident whereOccurrenceTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Incident whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Incident whereAttackFlowId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Incident whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Incident whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Incident whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Incident whereUserId($value)
 */
class Incident extends Model
{
    use SoftDeletes;

    protected $table = 'incident';
}
