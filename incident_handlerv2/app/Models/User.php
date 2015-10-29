<?php

namespace App\Models;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Http\Request;

/**
 * App\Models\User
 *
 * @property Person $person
 * @property integer $id
 * @property integer $person_id
 * @property integer $user_type_id
 * @property string $username
 * @property string $password
 * @property boolean $active
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePersonId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUserTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDeletedAt($value)
 * @property \App\Models\UserType $type
 */
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
            'active' => 'required',
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
        return $this->belongsTo('App\Models\Person', 'person_id');
    }

    /**
     * Relación entre UserType->User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo('App\Models\UserType', 'user_type_id');
    }

    public function isAdmin()
    {
        return ($this->type->name === 'admin');
    }
}
