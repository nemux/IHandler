<?php

namespace App\Models\Incident;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Incident\IncidentAttackCategory
 *
 * @property integer $id
 * @property integer $incident_id
 * @property integer $attack_category_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property integer $user_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentAttackCategory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentAttackCategory whereIncidentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentAttackCategory whereAttackCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentAttackCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentAttackCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentAttackCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\IncidentAttackCategory whereUserId($value)
 */
class IncidentAttackCategory extends Model
{
    use SoftDeletes;

    protected $table = 'incident_attack_category';

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
}
