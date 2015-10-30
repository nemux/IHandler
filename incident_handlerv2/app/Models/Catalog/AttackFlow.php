<?php

namespace App\Models\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

/**
 * App\Models\Catalog\AttackFlow
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\AttackFlow whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\AttackFlow whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\AttackFlow whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\AttackFlow whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\AttackFlow whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\AttackFlow whereDeletedAt($value)
 */
class AttackFlow extends Model
{
    use SoftDeletes;

    protected $table = 'attack_flow';

    private static $attributeNames = [
        'name' => 'Nombre del Flujo del Ataque',
        'description' => 'Descripción del Flujo del Ataque',
    ];

    public static function validateCreate(Request $request, Controller $controller)
    {
        $controller->validate($request, [
            'name' => 'required|max:255',
            'description' => 'max:255'
        ], [], AttackFlow::$attributeNames);
    }

    public static function validateUpdate(Request $request, Controller $controller)
    {
        AttackFlow::validateCreate($request, $controller);
    }
}
