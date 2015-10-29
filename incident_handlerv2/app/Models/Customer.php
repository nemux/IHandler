<?php

namespace App\Models;


use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;


/**
 * App\Models\Customer
 *
 * @property integer $id
 * @property string $name
 * @property string $business_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property integer $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection|CustomerContact[] $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection|CustomerAsset[] $assets
 * @property-read \Illuminate\Database\Eloquent\Collection|CustomerEmployee[] $employees
 * @property-read \Illuminate\Database\Eloquent\Collection|CustomerPage[] $pages
 * @property-read \Illuminate\Database\Eloquent\Collection|SurveillanceCase[] $surveillances
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer whereBusinessName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer whereUserId($value)
 * @property string $mimetype
 * @property string $logo
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer whereMimetype($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer whereLogo($value)
 * @property string $otrs_customer_id
 * @property string $otrs_user_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer whereOtrsCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer whereOtrsUserId($value)
 */
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

    public function surveillances()
    {
        return $this->hasMany(SurveillanceCase::class, 'customer_id');
    }
}
