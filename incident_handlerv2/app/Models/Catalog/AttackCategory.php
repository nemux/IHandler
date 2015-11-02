<?php

namespace App\Models\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

/**
 * App\Models\Catalog\AttackCategory
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\AttackCategory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\AttackCategory whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\AttackCategory whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\AttackCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\AttackCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\AttackCategory whereDeletedAt($value)
 */
class AttackCategory extends Model
{
    use SoftDeletes;

    protected $table = 'attack_category';
    private static $attributeNames = [
        'name' => 'Nombre de la Categoría',
        'description' => 'Descripción de la Categoría',
    ];

    public static function validateCreate(Request $request, Controller $controller)
    {
        $controller->validate($request, [
            'name' => 'required|max:255',
            'description' => 'max:255'
        ], [], AttackCategory::$attributeNames);
    }

    public static function validateUpdate(Request $request, Controller $controller)
    {
        AttackCategory::validateCreate($request, $controller);
    }
}
