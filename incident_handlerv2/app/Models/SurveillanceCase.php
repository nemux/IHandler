<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\SurveillanceCase
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $criticity_id
 * @property string $title
 * @property string $description
 * @property string $recommendation
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveillanceCase whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveillanceCase whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveillanceCase whereCriticityId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveillanceCase whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveillanceCase whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveillanceCase whereRecommendation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveillanceCase whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveillanceCase whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveillanceCase whereDeletedAt($value)
 * @property-read Criticity $criticity
 * @property-read Customer $customer
 */
class SurveillanceCase extends Model
{
    use SoftDeletes;
    /**
     * Permite borrado lógico
     * @var bool
     */
    protected $softDelete = true;
    protected $table = 'surveillance_case';
}
