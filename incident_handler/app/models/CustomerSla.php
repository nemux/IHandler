<?php

class CustomerSla extends Eloquent{
    /**
     * The database table used by the model.
     * @var string
     */
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $table = 'customer_sla';
    protected $fillable = ['customers_id','reminder_low','close_low','reminder_medium','close_medium','reminder_high','close_high'];

    public function customer()
    {
        return $this->belongsTo('Customer','customers_id','id');
    }
}