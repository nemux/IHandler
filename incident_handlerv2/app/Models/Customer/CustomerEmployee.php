<?php

namespace App\Models\Customer;

use App\Http\Controllers\Controller;
use App\Models\Person\Person;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Customer\CustomerEmployee
 *
 * @property integer $id
 * @property integer $person_id
 * @property integer $customer_id
 * @property string $email
 * @property string $phone
 * @property string $comments
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property integer $user_id
 * @property-read Person $person
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerEmployee whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerEmployee wherePersonId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerEmployee whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerEmployee whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerEmployee wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerEmployee whereComments($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerEmployee whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerEmployee whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerEmployee whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerEmployee whereUserId($value)
 */
class CustomerEmployee extends Model
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
