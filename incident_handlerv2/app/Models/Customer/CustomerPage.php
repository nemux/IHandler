<?php

namespace App\Models\Customer;

use App\Models\Link\Link;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Customer\CustomerPage
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $link_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property integer $user_id
 * @property-read Link $link
 * @property-read Customer $customer
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerPage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerPage whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerPage whereLinkId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerPage whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerPage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerPage whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerPage whereUserId($value)
 */
class CustomerPage extends Model
{
    use SoftDeletes;
    /**
     * Permite borrado lógico
     * @var bool
     */
    protected $softDelete = true;
    protected $table = 'customer_page';

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

    public function link()
    {
        return $this->belongsTo(Link::class, 'link_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
