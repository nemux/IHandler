<?php

class CustomerEmployee extends Eloquent
{

    /**
     * The database table used by the model.
     * @var string
     */
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $table = 'customer_employees';
    protected $fillable = ['customer_id', 'name', 'lastname', 'corp_email', 'personal_email', 'socialmedia', 'comments'];


    public function customer()
    {
        return $this->belongsTo('Customer', 'customer_id', 'id');
    }
}
