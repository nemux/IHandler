<?php

class Attack extends Eloquent {

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'attacks';
	protected $fillable = ['name','description'];
	protected $softDelete = true;


	public function incident(){
		return $this->belongsTo('Incident','incidents_id','id');
	}

}
