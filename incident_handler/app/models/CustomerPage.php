<?php

class CustomerPage extends Eloquent
{

    /**
     * The database table used by the model.
     * @var string
     */
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $table = 'customer_pages';
    protected $fillable = ['customer_id', 'page_type_id', 'url', 'comments'];

    public function customer()
    {
        return $this->belongsTo('Customer', 'customer_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo('PageType', 'page_type_id', 'id');
    }
}