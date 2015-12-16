<?php

namespace App\Models\User;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserType extends BaseModel
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
