<?php

namespace App\Http\Controllers;

use App\Models\Customer\CustomerAsset;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomerAssetController extends Controller
{


    /**
     * Stores New Asset form Customer
     * @param Request $request
     */
    public function store(Request $request)
    {
        \Log::info($request->except('_token'));

        $asset = new CustomerAsset();
        $asset->customer_id = $request->get('customer_id');
        $asset->domain_name = $request->get('domain_name');
        $asset->ipv4 = $request->get('ipv4');
        $asset->ipv6 = $request->get('ipv6');
        $asset->comments = $request->get('comments');
        $asset->save();

        return redirect()->route('customer.show', $asset->customer_id)->withMessage('Se almacenó el nuevo activo del cliente');//->withTab('asset');
    }

    /**
     * Muestra una vista con la información de un activo de un cliente
     * @param $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $asset = CustomerAsset::findOrNew($id);
        return view('customer.asset.show', compact('asset'));
    }

    /**
     * Regresa una vista con la información de un activo de un cliente
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $asset = CustomerAsset::findOrNew($id);
        return view('customer.asset.edit', compact('asset'));
    }

    /**
     *Actualiza la información de un activo de un cliente
     * @param Request $request
     * @param $id
     * @return
     */
    public function update(Request $request, $id)
    {
        $asset = CustomerAsset::findOrNew($id);
        $asset->domain_name = $request->get('domain_name');
        $asset->ipv4 = $request->get('ipv4');
        $asset->ipv6 = $request->get('ipv6');
        $asset->comments = $request->get('comments');
        $asset->save();

        return redirect()->route('customer.show', $asset->customer_id)->withMessage('Activo actualizado');//->withTab('asset');
    }


    /**
     * Elimina un activo de un cliente
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $asset = CustomerAsset::findOrNew($id);
        $domain_name = $asset->domain_name;
        $customer_id = $asset->customer_id;
        $asset->delete();

        return redirect()->route('customer.show', $customer_id)->withMessage('Se eliminó el activo ' . $domain_name);//->withTab('asset');
    }
}
