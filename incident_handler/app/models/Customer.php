<?php


class Customer extends Eloquent {
	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'customers';
	protected $fillable = ['company','phone','name','mail','otrs_userID','otrs_userlogin','otrs_usercustomerID','otrs_validID'];
	protected $softDelete = true;

	public function incidents(){
		return $this->hasMany('Incident','customers_id','id');
	}


}
