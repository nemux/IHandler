<?php

class Incident extends Eloquent{

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'incidents';
	protected $fillable = ['risk','criticity','impact','description','file','conclution','recomendation','categories_id','attacks_id','customers_id','incident_handler_id'];
	protected $softDelete = true;

  /*HAS MANY*/
  public function references()
	{
		return $this->hasMany('References','incidents_id','id');
	}

  public function times()
	{
		return $this->hasMany('Time','incidents_id','id');
	}

  	public function methods()
	{
		return $this->hasMany('Method','incidents_id','id');
	}

  public function images()
	{
		return $this->hasMany('Image','incidents_id','id');
	}

  public function applications()
	{
		return $this->hasMany('Application','incidents_id','id');
	}

  public function history()
	{
		return $this->hasMany('IncidentHistory','incidents_id','id');
	}

  public function affecteds()
	{
		return $this->hasMany('Affected','incidents_id','id');
	}


  /*BELONGS TO MANY*/

  public function attackers()
	{
		return $this->belongsToMany('Attacker','attackers_incidents','incidents_id','attackers_id');
	}
	public function rules()
	{
		return $this->belongsToMany('Rule','incidents_rules','incidents_id','rules_id');
	}

  /*BELONGS TO*/

	public function category(){
		return $this->belongsTo('Category','categories_id','id');
	}

	public function attack()
	{
		return $this->belongsTo('Attack','attacks_id','id');
	}

	public function customer()
	{
	  return $this->belongsTo('Customer','customers_id','id');
	}

	public function incident_handler()
	{
		return $this->belongsTo('IncidentHandler','handler_id','id');
	}

}
