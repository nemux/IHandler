<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Customer\CustomerEmployeePage
 *
 * @property integer $id
 * @property integer $customer_employee_id
 * @property integer $link_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property integer $user_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerEmployeePage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerEmployeePage whereCustomerEmployeeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerEmployeePage whereLinkId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerEmployeePage whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerEmployeePage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerEmployeePage whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerEmployeePage whereUserId($value)
 */
class CustomerEmployeePage extends Model
{
    use SoftDeletes;
    /**
     * Permite borrado lógico
     * @var bool
     */
    protected $softDelete = true;
    protected $table = 'customer_employee_page';

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
}
