<?php

namespace App\Models\Incident;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Annex extends Model
{
    use SoftDeletes;

    protected $table = 'incident_annex';

    protected static $attributeNames = [
        'title' => 'Título del Anexo',
        'field' => 'Campo de referencia',
        'content' => 'Contenido del Anexo'
    ];

    /**
     * Constructor de la clase
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        //Almacena de forma automática el ID del usuario que lo está invocando.

        if (\Auth::user() !== null)
            $this->user_id = \Auth::user()->id;
        else
            $this->user_id = 1;

        parent::__construct($attributes);
    }

    /**
     * Valida las entradas para crear un nuevo Anexo
     * @param Request $request
     * @param Controller $controller
     */
    public static function validateCreate(Request $request, Controller $controller)
    {
        $controller->validate($request, [
            'title' => 'required|max:255',
            'field' => 'required|max:255',
            'content' => 'required'
        ], [], Annex::$attributeNames);
    }
}
