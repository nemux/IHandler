<?php

namespace App\Models\Incident;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Incident\MachineType
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\MachineType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\MachineType whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\MachineType whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\MachineType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\MachineType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\MachineType whereDeletedAt($value)
 */
class MachineType extends Model
{
    use SoftDeletes;

    protected $table = 'machine_type';
}
