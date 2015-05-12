<?php

class Observation extends Eloquent {


  /**
   * The database table used by the model.
   * @var string
   */
  use SoftDeletingTrait;

  protected $dates = ['deleted_at'];
  protected $table = 'observations';
  protected $fillable = ['content','incidents_id','incident_handler_id','readed','created_by','attend'];

  public function incident()
  {
    return $this->belongsTo('Incident','incidents_id','id');
  }
  public function owner()
  {
    return $this->belongsTo('IncidentHandler','created_by','id');
  }
  public function incidentHandler()
  {
    return $this->belongsTo('IncidentHandler','incident_handler_id','id');
  }
}
