<?php

class TimeType extends Eloquent {


	/**
	 * The database table used by the model.
	 * @var string
	 */
  use SoftDeletingTrait;

  protected $dates = ['deleted_at'];
	protected $table = 'time_types';
	protected $fillable = ['name','description'];


}
