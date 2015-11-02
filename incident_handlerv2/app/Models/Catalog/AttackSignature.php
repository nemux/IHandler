<?php

namespace App\Models\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

/**
 * App\Models\Catalog\AttackSignature
 *
 * @property integer $id
 * @property string $signature
 * @property string $description
 * @property string $recommendation
 * @property string $risk
 * @property string $reference
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static Builder|AttackSignature whereId($value)
 * @method static Builder|AttackSignature whereSignature($value)
 * @method static Builder|AttackSignature whereDescription($value)
 * @method static Builder|AttackSignature whereRecommendation($value)
 * @method static Builder|AttackSignature whereRisk($value)
 * @method static Builder|AttackSignature whereReference($value)
 * @method static Builder|AttackSignature whereCreatedAt($value)
 * @method static Builder|AttackSignature whereUpdatedAt($value)
 * @method static Builder|AttackSignature whereDeletedAt($value)
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\AttackSignature whereName($value)
 */
class AttackSignature extends Model
{
    use SoftDeletes;

    protected $table = 'attack_signature';

    private static $attributeNames = [
        'name' => 'Nombre de la firma',
        'description' => 'Descripción',
        'recommendation' => 'Recomendación(es)',
        'risk' => 'Riesgo(s)',
        'reference' => 'Referencia(s)'
    ];

    public static function validateCreate(Request $request, Controller $controller)
    {
        $controller->validate($request, [
            'name' => 'required|max:255'
        ], [], AttackSignature::$attributeNames);
    }

    public static function validateUpdate(Request $request, Controller $controller)
    {
        AttackSignature::validateCreate($request, $controller);
    }
}
