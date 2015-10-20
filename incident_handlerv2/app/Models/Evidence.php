<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Evidence
 *
 * @property integer $id
 * @property integer $evidence_type_id
 * @property string $path
 * @property string $name
 * @property string $note
 * @property string $md5
 * @property string $sha1
 * @property string $sha256
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence whereEvidenceTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence wherePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence whereMd5($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence whereSha1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence whereSha256($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence whereDeletedAt($value)
 * @property string $mime_type
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence whereMimeType($value)
 * @property string $original_name
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evidence whereOriginalName($value)
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

    /**
     * Devuelve la ruta completa del fichero para poder ser consultado desde WEB
     * @return string
     */
    public function fullPath()
    {
        return url() . "/" . $this->path . $this->name;
    }
}
