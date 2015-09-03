<?php

class CustomerSocialmedia extends Eloquent
{

    /**
     * The database table used by the model.
     * @var string
     */
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $table = 'customer_socialmedia';
    protected $fillable = ['customer_id', 'reference', 'description', 'recommendation'];


    public function customer()
    {
        return $this->belongsTo('Customer', 'customer_id', 'id');
    }

}
