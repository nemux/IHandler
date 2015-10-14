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
 * @property string $customer_name
 * @property string $business_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer whereBusinessName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer whereCustomerName($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|CustomerEmployee[] $employees
 * @property-read \Illuminate\Database\Eloquent\Collection|CustomerAsset[] $assets
 * @property-read \Illuminate\Database\Eloquent\Collection|CustomerPage[] $pages
 * @property-read \Illuminate\Database\Eloquent\Collection|CustomerContact[] $contacts
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
}
