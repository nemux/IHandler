<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\User\UserType
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User\UserType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User\UserType whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User\UserType whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User\UserType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User\UserType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User\UserType whereDeletedAt($value)
 */
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
