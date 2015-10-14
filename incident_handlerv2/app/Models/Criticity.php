<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Criticity
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Criticity whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Criticity whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Criticity whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Criticity whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Criticity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Criticity whereDeletedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|SurveillanceCase[] $surveillance_cases
 */
class Criticity extends Model
{
    use SoftDeletes;
    /**
     * Permite borrado lógico
     * @var bool
     */
    protected $softDelete = true;

    protected $table = 'criticity';

//    public function surveillance_cases()
//    {
//        return $this->hasMany(SurveillanceCase::class, 'criticity_id');
//    }
}
