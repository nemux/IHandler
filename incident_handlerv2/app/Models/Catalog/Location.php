<?php

namespace App\Models\Catalog;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends BaseModel
{
    use SoftDeletes;

    protected $table = 'location';
}
