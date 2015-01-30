<?php

class Attack extends Eloquent {

	/**
	 * The database table used by the model.
	 * @var string
	 */
  use SoftDeletingTrait;

  protected $dates = ['deleted_at'];
	protected $table = 'attacks';
	protected $fillable = ['name','description'];


	public function incident(){
		return $this->hasOne('Incident','attacks_id','id');
	}

}
