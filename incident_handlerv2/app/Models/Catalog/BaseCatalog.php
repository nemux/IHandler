<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class BaseCatalog extends Model
{
    public $title;
    public $name;
    public $columns;
    public $tableHeader;
    public $idTable;
    public $createRoute;
    public $editRoute;
    public $deleteRoute;
    public $showRoute;
    public $formView;
    public $showView;

    /**
     * BaseCatalog constructor.
     *
     * @param array $title
     * @param $name
     * @param $columns
     * @param $tableHeader
     * @param $idTable
     * @param $createRoute
     * @param $editRoute
     * @param $deleteRoute
     * @param $showRoute
     * @param $formView
     * @param $showView
     */
    public function __construct($title,
                                $name,
                                $columns,
                                $tableHeader,
                                $idTable,
                                $createRoute,
                                $editRoute,
                                $deleteRoute,
                                $showRoute,
                                $formView,
                                $showView)
    {
        $this->title = $title;
        $this->name = $name;
        $this->columns = $columns;
        $this->tableHeader = $tableHeader;
        $this->idTable = $idTable;
        $this->createRoute = $createRoute;
        $this->editRoute = $editRoute;
        $this->deleteRoute = $deleteRoute;
        $this->showRoute = $showRoute;
        $this->formView = $formView;
        $this->showView = $showView;
    }
}
