<?php

namespace App\Models;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Illuminate\Http\Request;

/**
 * App\Models\PersonContact
 *
 * @property integer $id
 * @property integer $person_id
 * @property string $email
 * @property string $phone
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PersonContact whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PersonContact wherePersonId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PersonContact whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PersonContact wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PersonContact whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PersonContact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PersonContact whereDeletedAt($value)
 */
class PersonContact extends Model
{
    use SoftDeletes;

    /**
     * Permite borrado lógico
     * @var bool
     */
    protected $softDelete = true;
    /**
     * Tabla referenciada a la clase
     * @var string
     */
    protected $table = 'person_contact';

    /**
     * Valida los campos en una actualización
     * @param Request $request
     * @param Controller $controller
     */
    public static function validateUpdate(Request $request, Controller $controller)
    {
        /**
         * Validation for PersonContact _form
         */
        $controller->validate($request, [
            'email' => 'max:60|email',
            'phone' => 'max:50',
        ]);
    }
}
