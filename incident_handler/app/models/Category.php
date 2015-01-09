<?php

class Category extends Eloquent {

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'categories';
	protected $fillable = ['name','description', 'time_range'];
	protected $softDelete = true;

}
