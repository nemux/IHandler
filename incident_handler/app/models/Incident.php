<?php

class Incident extends Eloquent{

	/**
	 * The database table used by the model.
	 * @var string
	 */
  use SoftDeletingTrait;

  protected $dates = ['deleted_at'];
	protected $table = 'incidents';
	protected $fillable = ['risk','stream','criticity','impact','description','file','conclution','recomendation','sensors_id','categories_id','attacks_id','customers_id','incident_handler_id','incidents_status_id'];


  /*HAS MANY*/
  public function reference()
	{
		return $this->hasOne('References','incidents_id','id');
	}

	public function ticket()
	{
		return $this->hasOne('Ticket','incidents_id','id');
	}

	public function incidentRule()
	{
		return $this->hasMany('IncidentRule','incidents_id','id');
	}
	public function incidentOccurence()
	{
		return $this->hasMany('IncidentOccurence','incidents_id','id');
	}
	public function srcDst()
	{
		return $this->hasMany('IncidentOccurence','incidents_id','id');
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

    public function recomendations()
	{
		return $this->hasMany('Recomendation','incidents_id','id');
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
	public function status(){
		return $this->belongsTo('IncidentStatus','incidents_status_id','id');
	}
	public function sensor(){
		return $this->belongsTo('Sensor','sensors_id','id');
	}

	public function attack()
	{
		return $this->belongsTo('Attack','attacks_id','id');
	}

	public function customer()
	{
	  return $this->belongsTo('Customer','customers_id','id');
	}

	public function handler()
	{
		return $this->belongsTo('IncidentHandler','incident_handler_id','id');
	}

}
