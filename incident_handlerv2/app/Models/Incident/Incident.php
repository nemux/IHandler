<?php

namespace App\Models\Incident;

use App\Http\Controllers\Controller;
use App\Models\Catalog\AttackCategory;
use App\Models\Catalog\AttackFlow;
use App\Models\Catalog\AttackSignature;
use App\Models\Catalog\AttackType;
use App\Models\Catalog\Criticity;
use App\Models\Customer\Customer;
use App\Models\Ticket\Ticket;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;


class Incident extends Model
{
    use SoftDeletes;

    protected $table = 'incident';

    protected $dates = ['created_at', 'updated_at'];

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
    public function __construct(array $attributes = [])
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
            'customer_id' => 'required|exists:customer,id',
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
     * Devuelve una lista con todos las evidencias de todo tipo de un incidente
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function allEvidences()
    {
        return $this->hasMany(IncidentEvidence::class, 'incident_id');
    }

    /**
     * Devuelve la lista de evidencias del Incidente
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evidences()
    {
        return $this->hasMany(IncidentEvidence::class, 'incident_id')->whereEvidenceTypeId(2);
    }

    /**
     * Devuelve la lista de evidencias de un incidente con estatus Cerrado
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evidencesForClosed()
    {
        return $this->hasMany(IncidentEvidence::class, 'incident_id')->whereEvidenceTypeId(3);
    }

    /**
     * Devuelve la lista de evidencias de un incidente con estatus Cerrado
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evidencesForFalsePositive()
    {
        return $this->hasMany(IncidentEvidence::class, 'incident_id')->whereEvidenceTypeId(4);
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

    public function ticket()
    {
        return $this->hasOne(Ticket::class, 'incident_id');
    }

    /**
     * Función que permite determinar si un incidente tiene al menos una máquina en lista negra
     *
     * @return bool
     */
    public function hasOneBlacklist()
    {

        foreach ($this->events as $event) {
            if ($event->source->blacklist || $event->target->blacklist)
                return true;
        }
        return false;
    }

    public function getGroupedEvents()
    {
        return IncidentEvent::generateArray($this);
    }

    /**
     * Devuelve la renderización de una vista HTML para el incidente en cuestión
     *
     * @return string
     */
    public function renderHtml()
    {
        $view = view('incident._preview', ['case' => $this])->render();
        return $view;
    }

    /**
     * Lista de anexos agregados al caso
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function annexes()
    {
        return $this->hasMany(Annex::class, 'incident_id')->orderBy('id', 'asc');
    }

    /**
     * Lista de notas (observaciones) agregadas al caso
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany(Note::class, 'incident_id')->orderBy('id', 'asc');
    }


    public function fieldEnabled()
    {
        return (isset($this->ticket->ticket_status_id) && $this->ticket->ticket_status_id >= 2) ? 'disabled' : '';
    }
}
