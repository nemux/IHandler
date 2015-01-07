<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Afected extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'afected';
	protected $fillable = ['source','datetime','affected_type_id','incident_id'];
	protected $softDelete = true;
	/**
	 * The attributes excluded from the model's JSON form.
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');
	public funcion incident(){
		return $this->belongsTo('incident','id');
	}

	public funcion affected_type(){
		return $this->belongsTo('affected_type','id');
	}

}