<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Method extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'method';
	protected $fillable = ['name','description','incident_id'];
	protected $softDelete = true;
	/**
	 * The attributes excluded from the model's JSON form.
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');
	public funcion incident(){
		return $this->belongsTo('Incident','id');
	}

}