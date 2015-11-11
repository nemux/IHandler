<?php

namespace App\Models\Surveillance;

use App\Http\Controllers\Controller;
use App\Models\Catalog\Criticity;
use App\Models\Customer\Customer;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;


class SurveillanceCase extends Model
{
//    use SoftDeletes;
    /**
     * Permite borrado lógico
     * @var bool
     */
//    protected $softDelete = true;
    protected $table = 'surveillance_case';

    protected static $attributeNames = [
        'title' => 'Título del Caso',
        'description' => 'Descripción del Caso',
        'customer_id' => 'Cliente',
        'criticity_id' => 'Criticidad'
    ];

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
     * Valida los inputs para crear un nuevo caso
     * @param Request $request
     * @param Controller $controller
     */
    public static function validateCreate(Request $request, Controller $controller)
    {
        $controller->validate($request, [
            'title' => 'required|max:255',
            'customer_id' => 'required|exists:customer,id',
            'criticity_id' => 'required|exists:criticity,id',
            'description' => 'required'
        ], [], SurveillanceCase::$attributeNames);
    }

    public static function validateUpdate(Request $request, Controller $controller)
    {
        SurveillanceCase::validateCreate($request, $controller);
    }

    /**
     * Relaciona un caso con el cliente al que pertenece
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Relaciona un caso con su criticidad
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function criticity()
    {
        return $this->belongsTo(Criticity::class, 'criticity_id');
    }

    public function evidences()
    {
        return $this->hasMany(SurveillanceCaseEvidence::class, 'surveillance_case_id');
    }
}
