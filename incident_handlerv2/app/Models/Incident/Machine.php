<?php

namespace App\Models\Incident;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Incident\Machine
 *
 * @property integer $id
 * @property string $ipv4
 * @property string $ipv6
 * @property string $mac
 * @property string $os
 * @property string $port
 * @property string $protocol
 * @property boolean $blacklist
 * @property integer $location_id
 * @property integer $machine_type_id
 * @property integer $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Machine whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Machine whereIpv4($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Machine whereIpv6($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Machine whereMac($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Machine whereOs($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Machine wherePort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Machine whereProtocol($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Machine whereShow($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Machine whereBlacklist($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Machine whereLocationId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Machine whereMachineTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Machine whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Machine whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Machine whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Machine whereDeletedAt($value)
 * @property boolean $hide
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Incident\Machine whereHide($value)
 */
class Machine extends Model
{
    use SoftDeletes;

    protected $table = 'machine';

    /**
     * Constructor de la clase
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        //Almacena de forma automática el ID del usuario que lo está invocando.

        if (\Auth::user() !== null)
            $this->user_id = \Auth::user()->id;

        parent::__construct($attributes);
    }

    public function __toString()
    {
        return $this->protocol . '://' . $this->ipv4 . ':' . $this->port;
    }

    public function json()
    {
        return $this->toJson();
    }
}
