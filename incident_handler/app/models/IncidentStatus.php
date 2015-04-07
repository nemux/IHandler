<?php


class IncidentStatus extends Eloquent {

	/**
	 * The database table used by the model.
	 * @var string
	 */
  use SoftDeletingTrait;

  protected $dates = ['deleted_at'];
	protected $table = 'incidents_status';
	protected $fillable = ['name','description'];


}
