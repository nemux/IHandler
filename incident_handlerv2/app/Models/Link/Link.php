<?php

namespace App\Models\Link;

use App\Http\Controllers\Controller;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;


class Link extends BaseModel
{
    use SoftDeletes;
    /**
     * Permite borrado lógico
     * @var bool
     */
    protected $softDelete = true;
    protected $table = 'link';
    protected static $attributeNames = [
        'link' => 'Enlcea',
        'title' => 'Título',
        'link_comments' => 'Comentarios',
        'link_type_id' => 'Tipo de Página'
    ];

    /**
     * Cosntructor de la clase
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

    public static function validateCreate(Request $request, Controller $controller)
    {
        $controller->validate($request, [
            'link' => 'required',
            'title' => 'max:255',
            'link_type_id' => 'required|exists:link_type,id'
        ], [], Link::$attributeNames);
    }

    public static function validateUpdate(Request $request, Controller $controller)
    {
        Link::validateCreate($request, $controller);
    }

    public function type()
    {
        return $this->belongsTo(LinkType::class, 'link_type_id');
    }
}