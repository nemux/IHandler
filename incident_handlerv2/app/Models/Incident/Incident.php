<?php

namespace App\Models\Incident;

use App\Http\Controllers\Controller;
use App\Models\Catalog\AttackCategory;
use App\Models\Catalog\AttackFlow;
use App\Models\Catalog\AttackSignature;
use App\Models\Catalog\AttackType;
use App\Models\Catalog\Criticity;
use App\Models\Customer\Customer;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

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
 * @property \Illuminate\Database\Eloquent\Collection|IncidentAttackCategory[] $categories
 * @property \Illuminate\Database\Eloquent\Collection|IncidentAttackSignature[] $signatures
 * @property \Illuminate\Database\Eloquent\Collection|IncidentCustomerSensor[] $sensors
 * @property \Illuminate\Database\Eloquent\Collection|IncidentEvent[] $events
 * @property \Illuminate\Database\Eloquent\Collection|IncidentEvidence[] $evidences
 * @property-read Customer $customer
 * @property-read User $user
 * @property-read AttackFlow $flow
 * @property-read Criticity $criticity
 */
class Incident extends Model
{
    use SoftDeletes;

    protected $table = 'incident';

    protected static $attributeNames = [
        'title' => 'Título del Incidente',
        'description' => 'Descripción del incidente',
        'recommendation' => 'Recomendaciones sobre el incidente',
        'reference' => 'Referencias de la investigación',

        'detection_time' => 'Hora de Detección',
        'detection_date' => 'Fecha de Detección',
        'occurrence_time' => 'Hora de Ocurrencia',
        'occurrence_date' => 'Fecha Ocurrencia',

        'flow_id' => 'Flujo del Ataque',
        'criticity_id' => 'Severidad (Criticidad) del Incidente',
        'impact' => 'Impacto',
        'risk' => 'Riesgo',
        'attack_type_id' => 'Tipo de ataque',
        'customer_id' => 'Cliente',
    ];

    /**
     * Constructor de la clase
     * @param array $attributes
     */
    public
    function __construct(array $attributes = [])
    {
        //Almacena de forma automática el ID del usuario que lo está invocando.

        if (\Auth::user() !== null)
            $this->user_id = \Auth::user()->id;

        parent::__construct($attributes);
    }

    public static function validateCreate(Request $request, Controller $controller)
    {
        $controller->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'recommendation' => 'required',
            'reference' => 'required',

            'detection_time' => 'required',
            'detection_date' => 'required',
            'occurrence_time' => 'required',
            'occurrence_date' => 'required',

            'flow_id' => 'required|exists:attack_flow,id',
            'criticity_id' => 'required|exists:criticity,id',
            'impact' => 'required|numeric',
            'risk' => 'required|numeric',
            'attack_type_id' => 'required|exists:attack_type,id',
            'customer_id' => 'Cliente',
        ], [], Incident::$attributeNames);
    }

    public static function validateUpdate(Request $request, Controller $controller)
    {
        Incident::validateCreate($request, $controller);
    }

    /**
     * Devuelve las categorias del incidente
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany(IncidentAttackCategory::class, 'incident_id');
    }

    /**
     * <b>TRUE</b>, si la categoría está seleccionada en el incidente
     * <b>FALSE</b>, si la categoría no está en el incidente
     *
     * @param AttackCategory $category
     *
     * @return bool
     */
    public function hasCategory(AttackCategory $category)
    {
        foreach ($this->categories as $cat) {
            if ($category->id == $cat->id) {
                return true;
            }
        }

        return false;
    }

    /**
     * Devuelve la lista de firmas del incidente
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function signatures()
    {
        return $this->hasMany(IncidentAttackSignature::class, 'incident_id');
    }

    public function signatures_list()
    {
        $list = '<ul>';
        foreach ($this->signatures as $signature) {
            $list .= '<li>' . $signature->signature->name . '</li>';
        }
        $list .= '</ul>';
        return $list;
    }

    /**
     * Resuelve si una firma está relacionada con las firmas de un incidente
     *
     * @param AttackSignature $signature
     * @return bool
     */
    public function hasSignature(AttackSignature $signature)
    {
        foreach ($this->signatures as $sign) {
            if ($sign->id == $signature->id) {
                return true;
            }
        }
        return false;
    }

    /**
     * Devuelve la lista de sensores del incidente
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sensors()
    {
        return $this->hasMany(IncidentCustomerSensor::class, 'incident_id');
    }

    public function sensors_list()
    {
        $list = '<ul>';
        foreach ($this->sensors as $sensor) {
            $list .= '<li>' . $sensor->sensor->name . '</li>';
        }
        $list .= '</ul>';
        return $list;
    }

    /**
     * Devuelve la lista de eventos del incidente
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany(IncidentEvent::class, 'incident_id');
    }

    /**
     * Devuelve la lista de evidencias del Incidente
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evidences()
    {
        return $this->hasMany(IncidentEvidence::class, 'incident_id');
    }

    /**
     * Devuelve el Cliente con quien esta relacionado el incidente
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Devuelve el usuario que creo el incidente
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Devuelve la relación del Incidente y el flujo del ataque
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flow()
    {
        return $this->belongsTo(AttackFlow::class, 'attack_flow_id');
    }


    /**
     * Devuelve la relación del incidente y su criticidad
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function criticity()
    {
        return $this->belongsTo(Criticity::class, 'criticity_id');
    }

    public function type()
    {
        return $this->belongsTo(AttackType::class, 'attack_type_id');
    }
}
