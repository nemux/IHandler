<?php

namespace App\Models\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

/**
 * App\Models\Catalog\Criticity
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Criticity whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Criticity whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Criticity whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Criticity whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Criticity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Criticity whereDeletedAt($value)
 */
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
