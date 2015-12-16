<?php

namespace App\Models\Link;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;


class LinkType extends BaseModel
{
    use SoftDeletes;

    /**
     * Permite borrado lógico
     * @var bool
     */
    protected $softDelete = true;

    /**
     * Table name
     * @var string
     */
    protected $table = 'link_type';
}
