<?php

namespace App\Models\Incident;

use App\Http\Controllers\AssetController;
use App\Models\Asset\Asset;
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
        return $this->protocol . '://' . $this->asset->ipv4 . ':' . $this->port;
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function json()
    {
        $location = $this->location;
        $this->location_name = isset($location->name) ? $location->name : '';
        $this->ipv4 = $this->asset->ipv4;
        $this->ipv6 = $this->asset->ipv6;
        $this->asset_id = $this->asset->id;
        return $this->toJson();
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }


    /**
     * Convierte los parametros de un arreglo en un objeto tipo Machine
     * @param $data
     * @return Machine
     */
    public static function getMachine($data)
    {
        $ipv4 = $data['ipv4'];
        $ipv6 = isset($data['ipv6']) ? $data['ipv6'] : null;
        $asset = AssetController::saveUpdate($ipv4, $ipv6);

        $machine = new Machine();
        if (isset($data['id']))
            $machine = Machine::findOrNew($data['id'])->first();

        $machine->asset_id = $asset->id;

        $machine->protocol = ($data['protocol'] != null) ? $data['protocol'] : '';
        $machine->port = ($data['port'] != null) ? $data['port'] : '';
        $machine->os = ($data['os'] != null) ? $data['os'] : '';
        $machine->mac = ($data['mac'] != null) ? $data['mac'] : '';
        $machine->location_id = ($data['location'] != null) ? $data['location'] : null;
        $machine->machine_type_id = $data['type'];
        $machine->blacklist = $data['blacklist'];
        $machine->hide = $data['hide'];
        return $machine;
    }
}
