<?php


class Application extends Eloquent {

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'applications';
	protected $fillable = ['name','description','incidents_id'];
	protected $softDelete = true;

	public function affected(){
		return $this->belongsTo('Incident','incidents_id','id');
	}

}
