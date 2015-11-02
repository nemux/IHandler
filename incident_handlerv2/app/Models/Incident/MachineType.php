<?php

namespace App\Models\Incident;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MachineType extends Model
{
    use SoftDeletes;

    protected $table = 'machine_type';
}
