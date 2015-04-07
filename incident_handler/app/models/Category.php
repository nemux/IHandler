<?php

class Category extends Eloquent {

	/**
	 * The database table used by the model.
	 * @var string
	 */
  use SoftDeletingTrait;

  protected $dates = ['deleted_at'];
	protected $table = 'categories';
	protected $fillable = ['name','description', 'time_range'];

}
