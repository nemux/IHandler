<?php

namespace App\Models\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * App\Models\Catalog\AttackType
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $attack_type_parent_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property mixed attributeNames
 * @method static Builder|AttackType whereId($value)
 * @method static Builder|AttackType whereName($value)
 * @method static Builder|AttackType whereDescription($value)
 * @method static Builder|AttackType whereAttackTypeParentId($value)
 * @method static Builder|AttackType whereCreatedAt($value)
 * @method static Builder|AttackType whereUpdatedAt($value)
 * @method static Builder|AttackType whereDeletedAt($value)
 */
class AttackType extends Model
{

    use SoftDeletes;

    private static $attributeNames = [
        'name' => 'Nombre del Ataque',
        'description' => 'Descripción del Ataque',
    ];

    protected $table = 'attack_type';

    public static function validateCreate(Request $request, Controller $controller)
    {
        $controller->validate($request, [
            'name' => 'required|max:255',
            'description' => 'max:255'
        ], [], AttackType::$attributeNames);
    }

    public function parent()
    {
        return $this->belongsTo(AttackType::class, 'attack_type_parent_id');
    }
}
