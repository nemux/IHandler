<?php

class IncidentHandler extends Eloquent {

	/**
	 * The database table used by the model.
	 * @var string
	 */
  use SoftDeletingTrait;

  protected $dates = ['deleted_at'];
	protected $table = 'incident_handler';
	protected $fillable = ['name','lastname','mail','phone'];

	public function access(){
		return $this->hasOne('Access','incident_handler_id','id');
	}
	public function incidentHistory(){
		return $this->hasMany('IncidentHistory','incident_handler_id','id');
	}

	public function incidents(){
		return $this->hasMany('Incident','incident_handler_id','id');
	}
	public function tickets(){
		return $this->hasMany('Ticket','incident_handler_id','id');
	}
  public function observations(){
    return $this->hasMany('Observation','incident_handler_id','id');
  }

	public function attackerHistory(){
		return $this->hasMany('AttackerHistory','incident_handler_id','id');
	}

	public function ticketHistory(){
		return $this->hasMany('TicketHistory','incident_handler_id','id');
	}

}
