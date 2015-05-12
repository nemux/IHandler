<?php

class Notification extends Eloquent {


  protected $table = 'notifications';
  protected $fillable = ['content','incident_handler_id','relevance'];


  public function incidentHandler()
  {
    return $this->belongsTo('IncidentHandler','incident_handler_id','id');
  }
}
