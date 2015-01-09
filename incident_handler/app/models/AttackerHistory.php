<?php

class AttackerHistory extends Eloquent {

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'attackers_history';
	protected $fillable = ['port','protocol','operative_system','function','datetime','attackers_id','incident_handler_id'];
	protected $softDelete = true;

	//la notacion estandar es de la siguente manera: la funcion se llama con el nombre de la que la genera y
	//el nombre de la que genera, si es necesario se agregan letras adicionales para evitar la duplicidad

	public function attacker(){
		return $this->belongsTo('Attacker','attackers_id','id');
	}
	public function incidentHandler()
	{
		return $this->belongsTo('IncidentHandler','incident_handler_id','id')
	}
}
