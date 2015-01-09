<?php

class Time extends Eloquent {

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'time';
	protected $fillable = ['datetime','zone','time_types_id','incidents_id'];
	protected $softDelete = true;


	public function type(){
		return $this->belongsTo('TimeType','time_types_id','id');
	}
	public function incident(){
		return $this->belongsTo('Incident','incidents_id','id');
	}
}
