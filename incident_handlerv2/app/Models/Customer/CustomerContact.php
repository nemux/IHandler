<?php

namespace App\Models\Customer;

use App\Models\Person\Person;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerContact extends Model
{
    use SoftDeletes;

    /**
     * Tabla relacionada con la clase
     * @var string
     */
    protected $table = 'customer_contact';
    /**
     * Permite borrado lógico
     * @var bool
     */
    protected $softDelete = true;

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
     * Relación entre Persona->CustomerContact
     */
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }
}
