<?php

namespace App\Models\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

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

    public static function validateUpdate(Request $request, Controller $controller)
    {
        AttackType::validateCreate($request, $controller);
    }

    public function parent()
    {
        return $this->belongsTo(AttackType::class, 'attack_type_parent_id');
    }
}
