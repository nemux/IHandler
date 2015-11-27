<?php

namespace App\Models\Customer;


use App\Http\Controllers\Controller;
use App\Models\Surveillance\SurveillanceCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Customer extends Model
{
    use SoftDeletes;
    /**
     * Permite borrado lógico
     * @var bool
     */
    protected $softDelete = true;
    protected $table = 'customer';
    protected static $attributeNames = [
        'customer_name' => 'Nombre de la compañía',
        'business_bame' => 'Razón Social'
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
     * Valida que los parámetros pasados por un Request sean correctos con respecto al modelo de base de datos
     * @param Request $request
     * @param Controller $controller
     */
    public static function validateCreate(Request $request, Controller $controller)
    {
        $controller->validate($request, [
            'customer_name' => 'required|max:255',
            'business_bame' => 'max:255'
        ], [], Customer::$attributeNames);
    }

    /**
     * Lista de contactos del cliente
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany(CustomerContact::class, 'customer_id');
    }

    /**
     * Devuelve una lista de activos de un cliente
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assets()
    {
        return $this->hasMany(CustomerAsset::class, 'customer_id');
    }

    /**
     * Regresa una lista de empleados del cliente
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees()
    {
        return $this->hasMany(CustomerEmployee::class, 'customer_id');
    }

    /**
     * Regresa una lista de las páginas reportadas al cliente
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany(CustomerPage::class, 'customer_id');
    }


    /**
     * Devuelve una lista con los casos de cibervigilancia del cliente
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function surveillances()
    {
        return $this->hasMany(SurveillanceCase::class, 'customer_id');
    }

    /**
     * Devuelve una lista de los sensores registrados al cliente
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sensors()
    {
        return $this->hasMany(CustomerSensor::class, 'customer_id');
    }


    /**
     * Regresa una cadena con los correos electrónicos separados por punto y coma (;)
     *
     * @return string
     */
    public function semicolonSeparatedEmails()
    {
        $emails = '';

        foreach ($this->contacts as $index => $contact) {
            $emails .= $contact->person->contact->email;
            if ($index < count($this->contacts) - 1) {
                $emails .= ';';
            }
        }

        return $emails;
    }
}
