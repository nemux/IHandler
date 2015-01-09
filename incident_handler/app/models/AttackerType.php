<?php


class AttackerType extends Eloquent {

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'attacker_types';
	protected $fillable = ['name','description'];
	protected $softDelete = true;

}
