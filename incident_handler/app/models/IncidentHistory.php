<?php
class IncidentHistory extends Eloquent {

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'incidents_history';
	protected $fillable = ['datetime','description','incidents_status_id','incident_handler_id','incidents_id'];
	protected $softDelete = true;

	public function incident_handler(){
		return $this->belongsTo('IncidentHandler','incident_handler_id','id');
	}

	public function incident()
	{
		return $this->belongsTo('Incident','incidents_id','id');
	}

	public function incident_status()
	{
		return $this->belongsTo('IncidentStatus','incidents_status_id','id');
	}
}
