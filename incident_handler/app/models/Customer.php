<?php


class Customer extends Eloquent {
	/**
	 * The database table used by the model.
	 * @var string
	 */
  use SoftDeletingTrait;

  protected $dates = ['deleted_at'];
	protected $table = 'customers';
	protected $fillable = ['company','phone','name','mail','otrs_userID','otrs_userlogin','otrs_usercustomerID','otrs_validID'];


	public function incidents(){
		return $this->hasMany('Incident','customers_id','id');
	}

    public function sla(){
        return $this->hasOne('CustomerSla','customers_id','id');
    }
}
