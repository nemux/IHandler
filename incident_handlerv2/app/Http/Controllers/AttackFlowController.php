<?php

namespace App\Http\Controllers;

use App\Models\Catalog\AttackFlow;
use App\Models\Catalog\BaseCatalog;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AttackFlowController extends Controller
{
    private $viewParams;

    public function __construct()
    {
        $this->viewParams = new BaseCatalog(
            'Tipo de Flujo',
            'Flujo',
            'null,null,null',
            '<th>#</th><th>Flujo</th><th></th>',
            'flow-table',
            'flow.create',
            'flow.edit',
            'flow.destroy',
            'flow.show',
            'catalog._generic_form',
            'catalog._generic_show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = AttackFlow::all();
        $base = $this->viewParams;

        return view('catalog.generic_index', compact('items', 'base'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new AttackFlow();
        $base = $this->viewParams;

        return view('catalog.generic_create', compact('model', 'base'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AttackFlow::validateCreate($request, $this);

        $item = new AttackFlow();
        $item->name = $request['name'];
        $item->description = $request['description'];
        $item->save();

        return redirect()->route('flow.index')->withMessage('Se agregó un nuevo Flujo de Ataque al catálogo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = AttackFlow::whereId($id)->first();
        $base = $this->viewParams;

        return view('catalog.generic_show', compact('item', 'base'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = AttackFlow::whereId($id)->first();
        $base = $this->viewParams;

        return view('catalog.generic_edit', compact('item', 'base', 'parents'));
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
        AttackFlow::validateUpdate($request, $this);

        $item = AttackFlow::whereId($id)->first();
        $item->name = $request['name'];
        $item->description = $request['description'];
        $item->save();

        return redirect()->route('flow.index')->withMessage('Se actualizó el Flujo ' . $item->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = AttackFlow::whereId($id)->first();
        $name = $item->name;
        $item->delete();

        return redirect()->route('flow.index')->withMessage('Se eliminó el Flujo ' . $name);
    }
}
