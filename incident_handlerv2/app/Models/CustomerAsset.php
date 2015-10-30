<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\CustomerAsset
 *
 * @property integer $id
 * @property integer $customer_id
 * @property string $domain_name
 * @property string $ipv4
 * @property string $ipv6
 * @property string $comments
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerAsset whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerAsset whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerAsset whereDomainName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerAsset whereIpv4($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerAsset whereIpv6($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerAsset whereComments($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerAsset whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerAsset whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerAsset whereDeletedAt($value)
 * @property-read Customer $customer
 * @property integer $user_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerAsset whereUserId($value)
 */
class CustomerAsset extends Model
{
    use SoftDeletes;
    /**
     * Permite borrado lógico
     * @var bool
     */
    protected $softDelete = true;
    protected $table = 'customer_asset';

    /**
     * Cosntructor de la clase
     */
    public function __construct(array $attributes = [])
    {
        //Almacena de forma automática el ID del usuario que lo está invocando.

        if (\Auth::user() !== null)
            $this->user_id = \Auth::user()->id;

        parent::__construct($attributes);
    }
}
