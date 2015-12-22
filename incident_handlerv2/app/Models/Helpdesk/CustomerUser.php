<?php

namespace App\Models\Helpdesk;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use App\Models\User\User;
use Illuminate\Http\Request;

class CustomerUser extends User
{

    protected $connection = 'hd_pgsql';

    protected $table = 'user';

    static protected $attributeNames = [
        'user_type' => 'Tipo de Usuario',
        'username' => 'Nombre de usuario',
        'password' => 'Contraseña',
        'customer' => 'Cliente',
        'active' => 'Usuario Activo',
    ];

    /**
     * Valida que los parámetros ingresados sean correctos para actualizar un usuario
     *
     * @param Request $request
     * @param Controller $controller
     */
    public static function validateUpdate(Request $request, Controller $controller)
    {
        /**
         * Validation for User _form
         */
        $controller->validate($request, [
            'user_type' => 'required',
        ], [], CustomerUser::$attributeNames);
    }

    public static function validateCreate(Request $request, Controller $controller)
    {
        CustomerUser::validateUpdate($request, $controller);

        $controller->validate($request, [
            'username' => 'required|unique:user|max:255',
            'customer' => 'required'
        ], [], CustomerUser::$attributeNames);
    }

    /**
     * Relación entre Person->User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo(CustomerUserPerson::class, 'person_id');
    }

    /**
     * Relación entre UserType->User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(CustomerUserType::class, 'user_type_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
