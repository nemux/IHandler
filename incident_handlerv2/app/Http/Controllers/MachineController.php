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
            $pos = strpos($field, 'event_');

            //Si comienza por $type
            if ($pos !== false) {
                $var = $request->get($field);

                $var = json_decode($var, true);
                $source = $var['source'];
                $target = $var['target'];

                if ($source['id'] !== null) {
                    \Log::info('getting source machine from id ' . $source['id']);
                    $src_machine = Machine::whereId($source['id'])->first();
                } else {
                    \Log::info('new source machine from id');
                    $src_machine = new Machine();
                }
                $src_machine->ipv4 = $source['ipv4'];
                if ($source['location'] !== '') {
                    $src_machine->location_id = $source['location'];
                }
                $src_machine->machine_type_id = $source['type'];
                $src_machine->port = $source['port'];
                $src_machine->protocol = $source['protocol'];
                $src_machine->os = $source['os'];
                $src_machine->mac = $source['mac'];
                $src_machine->blacklist = $source['blacklist'];
                $src_machine->hide = $source['hide'];
                $src_machine->save();

                if ($target['id'] !== null) {
                    \Log::info('getting target machine from id');
                    $dst_machine = Machine::whereId($target['id'])->first();
                } else {
                    \Log::info('new target machine');
                    $dst_machine = new Machine();
                }
                $dst_machine->ipv4 = $target['ipv4'];
                if ($request->get($target['id']) !== '') {
                    $src_machine->location_id = $target['location'];
                }
                $dst_machine->machine_type_id = $target['type'];
                $dst_machine->port = $target['port'];
                $dst_machine->protocol = $target['protocol'];
                $dst_machine->os = $target['os'];
                $dst_machine->mac = $target['mac'];
                $dst_machine->blacklist = $target['blacklist'];
                $dst_machine->hide = $target['hide'];
                $dst_machine->save();

                array_push($machines, ['source' => $src_machine, 'target' => $dst_machine]);
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
