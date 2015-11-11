<?php

namespace App\Models\Incident;

use App\Models\Catalog\AttackCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class IncidentAttackCategory extends Model
{
    use SoftDeletes;

    protected $table = 'incident_attack_category';

    /**
     * Constructor de la clase
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        //Almacena de forma automática el ID del usuario que lo está invocando.

        if (\Auth::user() !== null)
            $this->user_id = \Auth::user()->id;

        parent::__construct($attributes);
    }

    public function category()
    {
        return $this->belongsTo(AttackCategory::class, 'attack_category_id');
    }
}
