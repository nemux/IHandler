<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\CustomerEmployeePage
 *
 * @property integer $customer_id
 * @property integer $person_id
 * @property integer $page_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerEmployeePage whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerEmployeePage wherePersonId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerEmployeePage wherePageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerEmployeePage whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerEmployeePage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerEmployeePage whereDeletedAt($value)
 * @property integer $id
 * @property integer $customer_employee_id
 * @property integer $link_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerEmployeePage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerEmployeePage whereCustomerEmployeeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerEmployeePage whereLinkId($value)
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

//    public function employee()
//    {
//        //TODO no estoy seguro de que de esta forma se haga la relación de tablas
//        return $this->belongsToMany(CustomerEmployee::class, 'customer_employee', 'customer_id', 'person_id');
//    }
//
//    public function customer()
//    {
//        //TODO no estoy seguro de que de esta forma se haga la relación de tablas
//        return $this->belongsTo(Customer::class, 'customer_id');
//    }
//
//    public function page()
//    {
//        return $this->belongsTo(Page::class, 'page_id');
//    }
}
