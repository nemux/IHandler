<?php

namespace App\Models\Evidence;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;


class EvidenceType extends BaseModel
{
    use SoftDeletes;
    /**
     * Permite borrado lógico
     * @var bool
     */
    protected $softDelete = true;
    protected $table = 'evidence_type';
}
