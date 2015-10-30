<?php


class Customer extends Eloquent
{
    /**
     * The database table used by the model.
     * @var string
     */
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $table = 'customers';
    protected $fillable = ['company', 'phone', 'name', 'mail', 'otrs_userID', 'otrs_userlogin', 'otrs_usercustomerID', 'otrs_validID'];


    public function incidents()
    {
        return $this->hasMany('Incident', 'customers_id', 'id');
    }

    public function sla()
    {
        return $this->hasOne('CustomerSla', 'customers_id', 'id');
    }

    //Todas las relaciones correspondientes a Cibervigilancia
    public function assets()
    {
        return $this->hasMany('CustomerAsset', 'customer_id', 'id');
    }

    public function employees()
    {
        return $this->hasMany('CustomerEmployee', 'customer_id', 'id');
    }

    public function socialmedia()
    {
        return $this->hasMany('CustomerSocialmedia', 'customer_id', 'id');
    }

    public function pages()
    {
        return $this->hasMany('CustomerPage', 'customer_id', 'id');
    }
}
