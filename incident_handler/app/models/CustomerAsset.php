<?php

class CustomerAsset extends Eloquent
{

    /**
     * The database table used by the model.
     * @var string
     */
    use SoftDeletingTrait;

    public $timestamps = true;

    protected $dates = ['deleted_at'];
    protected $table = 'customer_assets';
    protected $fillable = ['customer_id', 'domain_name', 'ip', 'comments'];


    public function customer()
    {
        return $this->belongsTo('Customer', 'customer_id', 'id');
    }

}
