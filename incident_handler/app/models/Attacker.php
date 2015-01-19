<?php

class Attacker extends Eloquent {

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'attackers';
	protected $fillable = ['ip','location','incidents_id','attacker_types_id'];
	protected $softDelete = true;

	public function attackers(){
		return $this->belongsToMany('Incident','attacker_incident','attacker_id','incidents_id');
	}

	public function type(){
		return $this->belongsTo('AttackerType','attacker_types_id','id');
	}

  public function history(){
    return $this->hasMany('EventsHistory','attackers_id','id');
  }
}
