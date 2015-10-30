<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Customer\CustomerAsset
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
 * @property integer $user_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerAsset whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerAsset whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerAsset whereDomainName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerAsset whereIpv4($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerAsset whereIpv6($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerAsset whereComments($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerAsset whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerAsset whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerAsset whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Customer\CustomerAsset whereUserId($value)
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
