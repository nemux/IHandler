<?php

namespace App\Models\Incident;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncidentAttackCategory extends Model
{
    use SoftDeletes;

    protected $table = 'incident_attack_category';
}
