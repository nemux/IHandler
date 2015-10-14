<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Link
 *
 * @property integer $id
 * @property integer $page_type_id
 * @property string $link
 * @property string $comments
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link wherePageTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link whereLink($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link whereComments($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link whereDeletedAt($value)
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
}
