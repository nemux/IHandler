<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Incident_handler extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'incident_handler';
	protected $fillable = ['name','lastname','mail','phone'];
	protected $softDelete = true;
	/**
	 * The attributes excluded from the model's JSON form.
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');
	public function acces(){
		return $this->hasOne('Acces','incident_handler_id');
	}
	public function incident_history(){
		return $this->hasMany('Incident_history','incident_handler_id');
	}

	public function incident(){
		return $this->hasMany('Incident','incident_handler_id');
	}

	public function attacker_history(){
		return $this->hasMany('Attacker_history','incident_handler_id');
	}

	//public function ticket_history(){
	//	return $this->hasMany('Ticket_history','incident_handler_id');
	//}

}