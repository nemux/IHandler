<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserType extends Model
{
    //
    use SoftDeletes;

    /**
     * Permite borrado lógico
     * @var bool
     */
    protected $softDelete = true;

    /**
     * Tabla relacionada con la clase
     * @var string
     */
    protected $table = 'user_type';

    /**
     * Relación UserType->User
     *
     * @return static
     */
    static function types()
    {
        return UserType::all()->lists('description', 'id');
    }
}
