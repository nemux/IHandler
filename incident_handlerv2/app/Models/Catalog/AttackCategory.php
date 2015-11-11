<?php

namespace App\Models\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class AttackCategory extends Model
{
    use SoftDeletes;

    protected $table = 'attack_category';
    private static $attributeNames = [
        'name' => 'Nombre de la Categoría',
        'description' => 'Descripción de la Categoría',
        'time_range' => 'Rango de Tiempo',
    ];

    public static function validateCreate(Request $request, Controller $controller)
    {
        $controller->validate($request, [
            'name' => 'required|max:255',
            'time_range' => 'max:255'
        ], [], AttackCategory::$attributeNames);
    }

    public static function validateUpdate(Request $request, Controller $controller)
    {
        AttackCategory::validateCreate($request, $controller);
    }
}
