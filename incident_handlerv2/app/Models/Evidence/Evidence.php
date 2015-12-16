<?php

namespace App\Models\Evidence;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;


class Evidence extends BaseModel
{
    use SoftDeletes;
    /**
     * Permite borrado lógico
     * @var bool
     */
    protected $softDelete = true;
    protected $table = 'evidence';

    protected static $customAttributes = [

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

    /**
     * Devuelve la ruta completa del fichero para poder ser consultado desde WEB
     * @return string
     */
    public function fullPath()
    {
        return url() . "/" . $this->path . $this->name;
    }
}
