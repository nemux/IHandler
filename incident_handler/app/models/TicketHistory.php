<?php
class TicketHistory extends Eloquent {

  /**
   * The database table used by the model.
   * @var string
   */
  protected $table = 'tickets_history';
  protected $fillable = ['datetime','incident_handler_id','tickets_status_id','tickets_id'];
  protected $softDelete = true;


  public function incident_handler(){
    return $this->belongsTo('IncidentHandler','incident_handler_id','id');
  }
  public function status(){
    return $this->belongsTo('IncidentStatus','incidents_status_id','id');
  }
  public function ticket(){
    return $this->belongsTo('Ticket','tickets_id','id');
  }

}
