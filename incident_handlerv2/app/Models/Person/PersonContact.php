<?php

namespace App\Models\Person;

use App\Http\Controllers\Controller;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;


class PersonContact extends BaseModel
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

    /**
     * Valida las entradas para crear un nuevo contacto de persona
     *
     * @param Request $request
     * @param Controller $controller
     */
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

    /**
     * Compara si el correo de  la persona a quien se enviar4á el email termina en @test.com, de ser así
     * el correo se redirige a la cuenta devinida en el parámetro DEVELOPER_EMAIL en el archivo .env
     *
     * @param $email
     * @return string
     */
    public static function compareEmail($email)
    {
        // Si el correo existe y termina con @test.com,
        // lo envía al correo del desarrollador para cuestiones de pruebas.
        if (!isset($email) || ends_with($email, '@test.com')) {
            $mailTo = env('DEVELOPER_EMAIL');
        } else {
            $mailTo = $email;
        }

        return $mailTo;
    }
}
