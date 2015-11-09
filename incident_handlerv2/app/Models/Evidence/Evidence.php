<?php

namespace App\Models\Evidence;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

/**
 * App\Models\Evidence\Evidence
 *
 * @property integer $id
 * @property integer $evidence_type_id
 * @property string $mime_type
 * @property string $path
 * @property string $name
 * @property string $original_name
 * @property string $note
 * @property string $md5
 * @property string $sha1
 * @property string $sha256
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property integer $user_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence\Evidence whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence\Evidence whereEvidenceTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence\Evidence whereMimeType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence\Evidence wherePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence\Evidence whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence\Evidence whereOriginalName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence\Evidence whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence\Evidence whereMd5($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence\Evidence whereSha1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence\Evidence whereSha256($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence\Evidence whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence\Evidence whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence\Evidence whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence\Evidence whereUserId($value)
 */
class Evidence extends Model
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
