<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Attacker extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'attacker';
	protected $fillable = ['ip','location','incident_id','attacker_type_id'];
	protected $softDelete = true;
	/**
	 * The attributes excluded from the model's JSON form.
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');
	public funcion incident_attacker(){
		return $this->belongsToMany('attacker_incident','id');
	}
	public funcion attacker_type(){
		return $this->belongsTo('attacker_type','id');
	}

}