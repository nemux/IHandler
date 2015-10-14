<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\CustomerPage
 *
 * @property integer $customer_id
 * @property integer $page_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerPage whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerPage wherePageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerPage whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerPage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerPage whereDeletedAt($value)
 * @property integer $id
 * @property integer $link_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerPage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerPage whereLinkId($value)
 * @property-read Page $page
 */
class CustomerPage extends Model
{
    use SoftDeletes;
    /**
     * Permite borrado lógico
     * @var bool
     */
    protected $softDelete = true;
    protected $table = 'customer_page';

    public function link()
    {
        return $this->belongsTo(Link::class, 'link_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
