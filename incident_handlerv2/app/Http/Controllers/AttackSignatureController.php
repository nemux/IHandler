<?php

namespace App\Http\Controllers;

use App\Models\Catalog\AttackSignature;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AttackSignatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $signatures = AttackSignature::orderBy('id')->get();

        return view('catalog.signature.index', compact('signatures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('catalog.signature.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AttackSignature::validateCreate($request, $this);

        $item = new AttackSignature();
        $item->signature = $request['signature'];
        $item->description = $request['description'];
        $item->recommendation = $request['recommendation'];
        $item->risk = $request['risk'];
        $item->reference = $request['reference'];
        $item->save();

        return redirect()->route('signature.index')->withMessage('Se agregó la Firma ' . $item->signature);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = AttackSignature::whereId($id)->first();

        return view('catalog.signature.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $item = AttackSignature::whereId($id)->first();

        return view('catalog.signature.edit', compact('item'));
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
        AttackSignature::validateUpdate($request, $this);

        $item = AttackSignature::whereId($id)->first();
        $item->signature = $request['signature'];
        $item->description = $request['description'];
        $item->recommendation = $request['recommendation'];
        $item->risk = $request['risk'];
        $item->reference = $request['reference'];
        $item->save();

        return redirect()->route('signature.index')->withMessage('Se actualizó la Firma ' . $item->signature);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = AttackSignature::whereId($id)->first();
        $name = $item->signature;
        $item->delete();

        return redirect()->route('signature.index')->withMessage('Se eliminó la Firma ' . $name);
    }
}
