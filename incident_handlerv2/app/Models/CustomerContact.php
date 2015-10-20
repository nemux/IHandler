<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\CustomerContact
 *
 * @property integer $customer_id
 * @property integer $person_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerContact whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerContact wherePersonId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerContact whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerContact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerContact whereDeletedAt($value)
 * @property integer $id
 * @property-read Person $person
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerContact whereId($value)
 * @property integer $user_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerContact whereUserId($value)
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
    public function __construct()
    {
        //Almacena de forma automática el ID del usuario que lo está invocando.
        $this->user_id = \Auth::user()->id;
    }

    /**
     * Relación entre Persona->CustomerContact
     */
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }
}
