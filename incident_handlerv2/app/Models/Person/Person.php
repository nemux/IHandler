<?php

namespace App\Models\Person;

use App\Http\Controllers\Controller;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;


class Person extends BaseModel
{
    use SoftDeletes;

    /**
     * Tabla relacionada con la clase
     * @var string
     */
    protected $table = 'person';
    /**
     * Permite borrado lógico
     * @var bool
     */
    protected $softDelete = true;
    /**
     * Campos visibles
     * @var array
     */
    protected $visible = ['id', 'name', 'lname', 'mname', 'sex'];

    protected static $attributeNames = [
        'name' => 'Nombre',
        'lname' => 'Apellido Paterno',
        'mname' => 'Apellido Materno',
        'sex' => 'Sexo'
    ];

    /**
     * Concatena los campos de nombres para obtener una referencia de nombre completo de una persona
     * @return string
     */
    public function fullName()
    {
        return $this->name . " " . $this->lname . " " . $this->mname;
    }

    /**
     * Valida que los campos pasados como parametros sean correctos para actualizar un objeto
     *
     * @param Request $request
     * @param Controller $controller
     */
    public static function validateUpdate(Request $request, Controller $controller)
    {
        Person::validateCreate($request, $controller);
    }

    /**
     * Valida que los campos pasados como parámetros sean correctos para almacenar un objeto
     *
     * @param Request $request
     * @param Controller $controller
     */
    public static function validateCreate(Request $request, Controller $controller)
    {
        /**
         * Validation for Person _form
         */
        $controller->validate($request, [
            'name' => 'required|max:255',
            'lname' => 'required|max:255',
            'mname' => 'max:255',
            'sex' => 'required'
        ], [], Person::$attributeNames);
    }

    /**
     * Relación Person->PersonContact
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function contact()
    {
        return $this->hasOne(PersonContact::class, 'person_id');
    }
}
