<?php

namespace App\Models\Catalog;

use App\Http\Controllers\Controller;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class AttackFlow extends BaseModel
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
