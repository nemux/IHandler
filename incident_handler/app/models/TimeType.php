<?php

class TimeType extends Eloquent {


	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'time_types';
	protected $fillable = ['name','description'];
	protected $softDelete = true;

}
