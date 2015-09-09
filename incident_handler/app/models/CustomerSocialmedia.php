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
    protected $fillable = ['customer_id', 'reference', 'description', 'recommendation', 'title', 'criticity_id'];

    public function customer()
    {
        return $this->belongsTo('Customer', 'customer_id', 'id');
    }

    public function criticity()
    {
        return $this->belongsTo('Criticity', 'criticity_id', 'id');
    }

    public function evidences()
    {
        return $this->hasMany('SocialMediaEvidence', 'socialmedia_id', 'id');
    }

}
