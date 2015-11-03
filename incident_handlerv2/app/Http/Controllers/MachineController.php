<?php

namespace App\Http\Controllers;

use App\Models\Incident\Machine;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MachineController extends Controller
{

    /**
     * Obtiene de un $request todos los elementos que estén relacionados con evidencia.
     * @param Request $request
     * @return array
     */
    public static function getMachines(Request $request)
    {
        $values = $request->all();
        $machines = array();

        //Para todos los campos pasados a través del request
        foreach ($values as $field => $value) {
            //Verifica si el nombre del campo empieza con $type
            $pos = strpos($field, 'src_');

            //Si comienza por $type
            if ($pos !== false) {
                //Contar los elementos ingresados como máquinas de este tipo
                $count = 0;
                $pos = strpos($field, 'src_ip_' . $count);

                //Si existe un campo con ese patrón de nombre
                if ($pos !== false) {
                    //Se almacenan los pares de Mṕaquinas origen yd estino

                    $src_machine = new Machine();
                    $src_machine->ipv4 = $request->get('src_ip_' . $count);
                    if ($request->get('src_location_' . $count) !== '') {
                        $src_machine->location_id = $request->get('src_location_' . $count);
                    }
                    $src_machine->machine_type_id = $request->get('src_type_' . $count);
                    $src_machine->port = $request->get('src_port_' . $count);
                    $src_machine->protocol = $request->get('src_protocol_' . $count);
                    $src_machine->os = $request->get('src_os_' . $count);
                    $src_machine->mac = $request->get('src_mac_' . $count);
                    $src_machine->save();

                    $dst_machine = new Machine();
                    $dst_machine->ipv4 = $request->get('tar_ip_' . $count);
                    if ($request->get('tar_location_' . $count) !== '') {
                        $src_machine->location_id = $request->get('tar_location_' . $count);
                    }
                    $dst_machine->machine_type_id = $request->get('tar_type_' . $count);
                    $dst_machine->port = $request->get('tar_port_' . $count);
                    $dst_machine->protocol = $request->get('tar_protocol_' . $count);
                    $dst_machine->os = $request->get('tar_os_' . $count);
                    $dst_machine->mac = $request->get('tar_mac_' . $count);
                    $dst_machine->save();

                    $count++;
                    array_push($machines, ['source' => $src_machine, 'target' => $dst_machine]);
                } else {
                    break;
                }
            }
        }

        return $machines;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
