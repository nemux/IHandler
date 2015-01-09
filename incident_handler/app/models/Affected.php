<?php

class Affected extends Eloquent {

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'affected';
	protected $fillable = ['source','datetime','affected_types_id','incidents_id'];
	protected $softDelete = true;
	/**
	 * The attributes excluded from the model's JSON form.
	 * @var array
	 */

	public function incident(){
		return $this->belongsTo('Incident','incidents_id','id');
	}

	public function type(){
		return $this->belongsTo('AffectedType','affected_types_id','id');
	}

}
