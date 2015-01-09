<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Access extends Eloquent implements UserInterface, RemindableInterface {

  use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'access';
	protected $fillable = ['incident_handler_id','acces_type_id','user'];
	protected $softDelete = true;
	/**
	 * The attributes excluded from the model's JSON form.
	 * @var array
	 */
	protected $hidden = array('pass', 'remember_token');
  protected $guarded = array('id', 'active');

	//la notacion estandar es de la siguente manera: la funcion se llama con el nombre de la que la genera y
	//el nombre de la que genera, si es necesario se agregan letras adicionales para evitar la duplicidad

	public function incident_handler(){
		return $this->belongsTo('IncidentHandler','incident_handler_id','id');
	}

	public function type()
	{
		return $this->belongsTo('AccessType','access_types_id','id');
	}


}
