<?php

namespace App\Models\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

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
