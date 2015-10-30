<?php

namespace App\Models\Link;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

/**
 * App\Models\Link\LinkType
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link\LinkType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link\LinkType whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link\LinkType whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link\LinkType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link\LinkType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link\LinkType whereDeletedAt($value)
 */
class LinkType extends Model
{
    use SoftDeletes;

    /**
     * Permite borrado lógico
     * @var bool
     */
    protected $softDelete = true;

    /**
     * Table name
     * @var string
     */
    protected $table = 'link_type';
}
