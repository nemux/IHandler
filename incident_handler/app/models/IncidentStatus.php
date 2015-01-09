<?php


class IncidentStatus extends Eloquent {

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'incidents_status';
	protected $fillable = ['name','description'];
	protected $softDelete = true;

}
