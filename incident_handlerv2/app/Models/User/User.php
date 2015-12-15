<?php

namespace App\Models\User;

use App\Http\Controllers\Controller;
use App\Models\Person\Person;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Http\Request;


class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;

    static protected $attributeNames = [
        'user_type' => 'Tipo de Usuario',
        'username' => 'Nombre de usuario',
        'password' => 'Contraseña',
        'active' => 'Usuario Activo',
    ];

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'user';
    /**
     * Elimina objetos de forma lógica, no física
     * @var bool
     */
    protected $softDelete = true;

    /**
     * Campos rellenables
     * @var array
     */
    protected $fillable = ['person_id', 'user_type_id', 'username', 'active'];

    /**
     * Campos visibles en una consulta
     * @var array
     */
    protected $visible = ['id', 'person_id', 'user_type_id', 'username', 'active'];

    /**
     * Campos ocultos en una consulta
     * @var array
     */
    protected $hidden = ['password', 'token'];

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
//            'active' => 'required',
        ], [], User::$attributeNames);
    }

    public static function validateCreate(Request $request, Controller $controller)
    {
        User::validateUpdate($request, $controller);

        $controller->validate($request, [
            'username' => 'required|unique:user|max:255',
        ], [], User::$attributeNames);
    }

    /**
     * Valida que los parámetros ingresados sean correctos para actualizar la cotraseña de un usuario
     *
     * @param Request $request
     * @param Controller $controller
     */
    public static function validateChangePassword(Request $request, Controller $controller)
    {
        $controller->validate($request, [
            'password' => 'required|confirmed',
        ], [], User::$attributeNames);
    }

    /**
     * Relación entre Person->User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    /**
     * Relación entre UserType->User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

    public function isAdmin()
    {
        return ($this->type->name === 'admin');
    }

    /**
     * Valida si el usuario tiene ese rol definido
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->type->name === $role;
    }
}
