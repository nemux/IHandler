<?php

namespace App\Models\Incident;

use App\Http\Controllers\Controller;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Recommendation extends BaseModel
{
    use SoftDeletes;

    protected $table = 'incident_recommendation';

    protected static $attributeNames = [
        'content' => 'Contenido de la Recomendación'
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
            'content' => 'required'
        ], [], Recommendation::$attributeNames);
    }
}
