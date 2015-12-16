<?php

namespace App\Models\Customer;

use App\Http\Controllers\Controller;
use App\Models\BaseModel;
use App\Models\Person\Person;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class CustomerEmployee extends BaseModel
{
    use SoftDeletes;
    /**
     * Permite borrado lógico
     * @var bool
     */
    protected $softDelete = true;
    protected $table = 'customer_employee';

    /**
     * Atributos para validaciones
     * @var array
     */
    protected static $attributeNames = [
        'corp_email' => 'Correo Corporativo',
        'corp_phone' => 'Teléfono Corporativo',
    ];

    /**
     * Cosntructor de la clase
     */
    public function __construct(array $attributes = [])
    {
        //Almacena de forma automática el ID del usuario que lo está invocando.

        if (\Auth::user() !== null)
            $this->user_id = \Auth::user()->id;
        else
            $this->user_id = 1;

        parent::__construct($attributes);
    }


    /**
     * Valida las entradas del usuario
     * @param Request $request
     * @param Controller $controller
     */
    public static function validateCreate(Request $request, Controller $controller)
    {
        $controller->validate($request, [
            'corp_email' => 'max:60',
            'corp_phone' => 'max:50',
        ], [], CustomerEmployee::$attributeNames);
    }

    /**
     * Valida las entradas para una actualización de un objeto
     * @param Request $request
     * @param Controller $controller
     */
    public static function validateUpdate(Request $request, Controller $controller)
    {
        CustomerEmployee::validateCreate($request, $controller);
    }

    /**
     * Devuelve el elemento correspondiente al Empleado en cuestion
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }
}
