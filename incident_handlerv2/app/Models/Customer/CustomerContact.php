<?php

namespace App\Models\Customer;

use App\Models\Person\Person;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Customer\CustomerContact
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $person_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property integer $user_id
 * @property-read Person $person
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerContact whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerContact whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerContact wherePersonId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerContact whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerContact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerContact whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerContact whereUserId($value)
 */
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
