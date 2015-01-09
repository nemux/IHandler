<?php


class AffectedType extends Eloquent {

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'affected_types';
	protected $fillable = ['name','description'];
	protected $softDelete = true;

}
