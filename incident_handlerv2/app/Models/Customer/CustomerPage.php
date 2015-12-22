<?php

namespace App\Models\Customer;

use App\Models\BaseModel;
use App\Models\Link\Link;
use Illuminate\Database\Eloquent\SoftDeletes;


class CustomerPage extends BaseModel
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
        else
            $this->user_id = 1;

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
