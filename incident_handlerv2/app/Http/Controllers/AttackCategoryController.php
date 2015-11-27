<?php

namespace App\Http\Controllers;

use App\Models\Catalog\AttackCategory;
use App\Models\Catalog\BaseCatalog;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AttackCategoryController extends Controller
{
    private $viewParams;

    public function __construct()
    {
        $this->viewParams = new BaseCatalog(
            'Tipo de Categoría',
            'Categoría',
            'null,null,null',
            '<th>#</th><th>Categoría</th><th></th>',
            'category-table',
            'category.create',
            'category.edit',
            'category.destroy',
            'category.show',
            'catalog.category._form',
            'catalog.category._show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = AttackCategory::orderBy('id')->get();
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
        $model = new AttackCategory();
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
        AttackCategory::validateCreate($request, $this);

        $item = new AttackCategory();
        $item->name = $request['name'];
        $item->description = $request['description'];
        $item->save();

        return redirect()->route('category.index')->withMessage('Se agregó una nueva Categoria de Ataque al catálogo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = AttackCategory::whereId($id)->first();
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
        $item = AttackCategory::whereId($id)->first();
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
        AttackCategory::validateUpdate($request, $this);

        $item = AttackCategory::whereId($id)->first();
        $item->name = $request['name'];
        $item->description = $request['description'];
        $item->save();

        return redirect()->route('category.index')->withMessage('Se actualizó la Categoría ' . $item->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = AttackCategory::whereId($id)->first();
        $name = $item->name;
        $item->delete();

        return redirect()->route('category.index')->withMessage('Se eliminó la Categoría ' . $name);
    }
}
