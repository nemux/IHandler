<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class attacker_type extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'attacker_type';
	protected $fillable = ['name','description'];
	protected $softDelete = true;
	/**
	 * The attributes excluded from the model's JSON form.
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');
	public funcion attacker(){
		return $this->hasOne('attacker','attacker_type_id');
	}

}