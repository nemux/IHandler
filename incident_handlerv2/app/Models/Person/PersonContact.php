<?php

namespace App\Models\Person;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use \Illuminate\Http\Request;

/**
 * App\Models\Person\PersonContact
 *
 * @property integer $id
 * @property integer $person_id
 * @property string $email
 * @property string $phone
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Person\PersonContact whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Person\PersonContact wherePersonId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Person\PersonContact whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Person\PersonContact wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Person\PersonContact whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Person\PersonContact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Person\PersonContact whereDeletedAt($value)
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

    protected static $attributeNames = [
        'email' => 'Email',
        'phone' => 'Teléfono'
    ];

    /**
     * Valida los campos en una actualización
     * @param Request $request
     * @param Controller $controller
     */
    public static function validateUpdate(Request $request, Controller $controller)
    {
        PersonContact::validateCreate($request, $controller);
    }

    public static function validateCreate(Request $request, Controller $controller)
    {
        /**
         * Validation for PersonContact _form
         */
        $controller->validate($request, [
            'email' => 'required|max:60|email',
            'phone' => 'max:50',
        ], [], PersonContact::$attributeNames);
    }

    public static function compareEmail($email)
    {
        // Si el correo existe y termina con @test.com,
        // lo envía al correo del desarrollador para cuestiones de pruebas.
        if (!isset($email) || ends_with($email, '@test.com')) {
            $mailTo = 'dlopez@globalcybersec.com';
        } else {
            $mailTo = $email;
        }

        return $mailTo;
    }
}
