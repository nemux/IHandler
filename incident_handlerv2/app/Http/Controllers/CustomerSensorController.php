<?php

namespace App\Http\Controllers;

use App\Models\CustomerSensor;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomerSensorController extends Controller
{
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
        CustomerSensor::validateCreate($request, $this);

        $sensor = new CustomerSensor();
        $sensor->customer_id = $request['customer_id'];
        $sensor->name = $request['name'];
        $sensor->ipv4 = $request['ipv4'];
        $sensor->ipv6 = $request['ipv6'];
        $sensor->mount_point = $request['mount_point'];
        $sensor->save();

        return redirect()->route('customer.show', $sensor->customer_id)->withMessage('Se agregó el nuevo sensor ' . $sensor->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sensor = CustomerSensor::whereId($id)->first();

        return view('customer.sensor.show', compact('sensor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sensor = CustomerSensor::whereId($id)->first();

        return view('customer.sensor.edit', compact('sensor'));
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
        CustomerSensor::validateUpdate($request, $this);

        $sensor = CustomerSensor::whereId($id)->first();
        $sensor->name = $request['name'];
        $sensor->ipv4 = $request['ipv4'];
        $sensor->ipv6 = $request['ipv6'];
        $sensor->mount_point = $request['mount_point'];
        $sensor->save();

        return redirect()->route('sensor.show', $sensor->id)->withMessage('Se actualizaron los datos del sensor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sensor = CustomerSensor::findOrNew($id);
        $name = $sensor->name;
        $customer_id = $sensor->customer_id;

        $sensor->delete();

        return redirect()->route('customer.show', $customer_id)->withMessage("Se eliminó el sensor: $name");
    }
}
