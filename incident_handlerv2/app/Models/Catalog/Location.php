<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Catalog\Location
 *
 * @property integer $id
 * @property string $name
 * @property string $lat
 * @property string $lon
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Location whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Location whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Location whereLat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Location whereLon($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Location whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Location whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Location whereDeletedAt($value)
 */
class Location extends Model
{
    use SoftDeletes;

    protected $table = 'location';
}
