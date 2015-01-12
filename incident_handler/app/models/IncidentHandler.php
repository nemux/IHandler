<?php

class IncidentHandler extends Eloquent {

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'incident_handler';
	protected $fillable = ['name','lastname','mail','phone'];
	protected $softDelete = true;

	public function access(){
		return $this->hasOne('Access','incident_handler_id','id');
	}
	public function incident_history(){
		return $this->hasMany('IncidentHistory','incident_handler_id','id');
	}

	public function incidents(){
		return $this->hasMany('Incident','incident_handler_id','id');
	}
	public function tickets(){
		return $this->hasMany('Ticket','incident_handler_id','id');
	}

	public function attacker_history(){
		return $this->hasMany('AttackerHistory','incident_handler_id','id');
	}

	public function ticket_history(){
		return $this->hasMany('TicketHistory','incident_handler_id','id');
	}

}
