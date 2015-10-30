<?php

namespace App\Models\Link;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

/**
 * App\Models\Link\Link
 *
 * @property integer $id
 * @property integer $link_type_id
 * @property string $title
 * @property string $link
 * @property string $comments
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property integer $user_id
 * @property-read LinkType $type
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link\Link whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link\Link whereLinkTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link\Link whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link\Link whereLink($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link\Link whereComments($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link\Link whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link\Link whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link\Link whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link\Link whereUserId($value)
 */
class Link extends Model
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