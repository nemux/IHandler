<?php

class OccurenceHistory extends Eloquent {

	/**
	 * The database table used by the model.
	 * @var string
	 */
  use SoftDeletingTrait;

  protected $dates = ['deleted_at'];
	protected $table = 'occurences_history';
	protected $fillable = ['port','protocol','operative_system','function','location','datetime','occurences_id','incident_handler_id'];


	//la notacion estandar es de la siguente manera: la funcion se llama con el nombre de la que la genera y
	//el nombre de la que genera, si es necesario se agregan letras adicionales para evitar la duplicidad

	public function occurences(){
		return $this->belongsTo('Occurence','occurences_id','id');
	}
	public function incidentHandler()
	{
		return $this->belongsTo('IncidentHandler','incident_handler_id','id');
	}
}
