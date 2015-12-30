<?php

namespace App\Models\Incident;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncidentRecommendation extends BaseModel
{
    use SoftDeletes;

    protected $table = 'incident_recommendation';
}
