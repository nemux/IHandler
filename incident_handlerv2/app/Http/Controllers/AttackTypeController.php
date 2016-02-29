<?php

namespace App\Http\Controllers;

use Models\IncidentManager\Catalog\AttackType;
use Models\IncidentManager\Catalog\BaseCatalog;
use Illuminate\Http\Request;
use App\Http\Requests;

class AttackTypeController extends Controller
{

    private $viewParams;

    public function __construct()
    {
        $this->viewParams = new BaseCatalog(
            'Tipo de Ataque',
            'Ataque',
            'null,null,null',
            '<th>#</th><th>Ataque</th><th></th>',
            'attack-table',
            'attack.create',
            'attack.edit',
            'attack.destroy',
            'attack.show',
            'catalog.attack._form',
            'catalog.attack._show');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = AttackType::orderBy('id')->get();
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
        $base = $this->viewParams;
        $parents = AttackType::lists('name', 'id');
        $model = new AttackType();

        return view('catalog.generic_create', compact('base', 'model', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AttackType::validateCreate($request, $this);

        $attack = new AttackType();
        $attack->name = $request['name'];
        $attack->description = $request['description'];
        $attack->attack_type_parent_id = $request['attack_type_parent_id'];
        $attack->save();

        return redirect()->route('attack.index')->withMessage('Se agregó un nuevo ataque al catálogo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = AttackType::whereId($id)->first();
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
        $item = AttackType::whereId($id)->first();
        $parents = AttackType::where('id', '!=', $id)->lists('name', 'id');
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
        AttackType::validateCreate($request, $this);

        $attack = AttackType::whereId($id)->first();
        $attack->name = $request['name'];
        $attack->description = $request['description'];
        $attack->attack_type_parent_id = $request['attack_type_parent_id'];
        $attack->save();

        return redirect()->route('attack.index')->withMessage('Se actualizó al ataque ' . $attack->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attack = AttackType::whereId($id)->first();
        $name = $attack->name;
        $attack->delete();

        return redirect()->route('attack.index')->withMessage('Se eliminó el Ataque ' . $name);
    }
}
