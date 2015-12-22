<?php

namespace App\Models\Incident;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;


class MachineType extends BaseModel
{
    use SoftDeletes;

    protected $table = 'machine_type';
}
