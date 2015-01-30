<?php

class Privilege extends Eloquent {

	/**
	 * The database table used by the model.
	 * @var string
	 */
  use SoftDeletingTrait;

  protected $dates = ['deleted_at'];
	protected $table = 'privileges';
	protected $fillable = ['name','description'];


	public function access(){
		return $this->belongsToMany('Access','access_privileges','privileges_id','access_id');
	}

}
