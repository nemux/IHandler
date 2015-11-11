<?php

namespace App\Models\Incident;

use App\Models\Catalog\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


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

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function json()
    {
        $location = $this->location;
        $this->location_name = isset($location->name) ? $location->name : '';
        return $this->toJson();
    }


    /**
     * Convierte los parametros de un arreglo en un objeto tipo Machine
     * @param $data
     * @return Machine
     */
    public static function getMachine($data)
    {
        $machine = new Machine();
        $machine->protocol = $data['protocol'];
        $machine->ipv4 = $data['ipv4'];
        $machine->port = $data['port'];
        $machine->os = $data['os'];
        $machine->mac = $data['mac'];
        $machine->location_id = $data['location'];
        $machine->machine_type_id = $data['type'];
        $machine->blacklist = $data['blacklist'];
        $machine->hide = $data['hide'];
        return $machine;
    }
}
