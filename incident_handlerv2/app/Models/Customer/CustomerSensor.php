<?php

namespace App\Models\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;


class CustomerSensor extends Model
{
    use SoftDeletes;

    protected $table = 'customer_sensor';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected static $attributeNames = [
        'name' => 'Nombre del Sensor',
        'ipv4' => 'IPV4',
        'ipv6' => 'IPV6',
        'mount_point' => 'Punto de Montaje'];

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
        $controller->validate($request,
            [
                'name' => 'required|max:255',
                'ipv4' => 'required|max:255',
                'ipv6' => 'max:255',
                'mount_point' => 'max:255'
            ], [], CustomerSensor::$attributeNames);
    }

    public static function validateUpdate(Request $request, Controller $controller)
    {
        CustomerSensor::validateCreate($request, $controller);
    }
}
