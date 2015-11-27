<?php

namespace App\Models\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class Criticity extends Model
{
    use SoftDeletes;
    /**
     * Permite borrado lógico
     * @var bool
     */
    protected $softDelete = true;

    protected $table = 'criticity';

    private static $attributeNames = [
        'name' => 'Nombre de la Severidad',
        'description' => 'Descripción de la Severidad',
    ];

    public static function validateCreate(Request $request, Controller $controller)
    {
        $controller->validate($request, [
            'name' => 'required|max:255',
            'description' => 'max:255'
        ], [], Criticity::$attributeNames);
    }

    public static function validateUpdate(Request $request, Controller $controller)
    {
        Criticity::validateCreate($request, $controller);
    }
}
