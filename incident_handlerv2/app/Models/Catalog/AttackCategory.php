<?php

namespace App\Models\Catalog;

use App\Http\Controllers\Controller;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class AttackCategory extends BaseModel
{
    use SoftDeletes;

    protected $table = 'attack_category';
    private static $attributeNames = [
        'name' => 'Nombre de la Categoría',
        'description' => 'Descripción de la Categoría',
        'time_range' => 'Rango de Tiempo',
    ];

    /**
     * Realiza una validación de las entradas del usuario para crear una nueva categoría
     *
     * @param Request $request
     * @param Controller $controller
     */
    public static function validateCreate(Request $request, Controller $controller)
    {
        $controller->validate($request, [
            'name' => 'required|max:255',
            'time_range' => 'max:255'
        ], [], AttackCategory::$attributeNames);
    }

    /**
     * Realiza una validación de las entradas del usuario para actualizar una categoría.
     * @param Request $request
     * @param Controller $controller
     */
    public static function validateUpdate(Request $request, Controller $controller)
    {
        AttackCategory::validateCreate($request, $controller);
    }

    /**
     * Remueve la cadena que coincida con la expresión regular, comúnmente "CAT - 5" por ejemplo
     *
     * @return mixed
     */
    public function noCat()
    {
        $cat = preg_replace("/(CAT \\d* - )/", "$2", $this->name);
        return $cat;
    }
}
