<?php

namespace App\Http\Controllers;

use App\Models\Catalog\BaseCatalog;
use App\Models\Catalog\Criticity;
use Illuminate\Http\Request;
use App\Http\Requests;

class CriticityController extends Controller
{
    private $viewParams;

    public function __construct()
    {
        $this->viewParams = new BaseCatalog(
            'Tipo de Severidad (Criticidad)',
            'Severidad (Criticidad)',
            'null,null,null',
            '<th>#</th><th>Severidad</th><th></th>',
            'criticity-table',
            'criticity.create',
            'criticity.edit',
            'criticity.destroy',
            'criticity.show',
            'catalog.criticity._form',
            'catalog.criticity._show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Criticity::all();
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
        $model = new Criticity();
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
        Criticity::validateCreate($request, $this);

        $item = new Criticity();
        $item->name = $request['name'];
        $item->description = $request['description'];
        $item->save();

        return redirect()->route('criticity.index')->withMessage('Se agregó un nuevo nivel de severidad al catálogo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Criticity::whereId($id)->first();
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
        $item = Criticity::whereId($id)->first();
        $base = $this->viewParams;

        return view('catalog.generic_edit', compact('item', 'base'));
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
        Criticity::validateUpdate($request, $this);

        $item = Criticity::whereId($id)->first();
        $item->name = $request['name'];
        $item->description = $request['description'];
        $item->save();

        return redirect()->route('criticity.index')->withMessage('Se actualizó el nuevo nivel de severidad ' . $item->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Criticity::whereId($id)->first();
        $name = $item->name;
        $item->delete();

        return redirect()->route('criticity.index')->withMessage('Se eliminó el nivel de severidad ' . $name);
    }
}
