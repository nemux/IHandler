<?php

class IncidentOccurence extends Eloquent{

  /**
   * The database table used by the model.
   * @var string
   */
  protected $table = 'incidents_occurences';
  protected $fillable = ['incidents_id','source_id','destiny_id'];
  protected $softDelete = true;

  public function src(){
    return $this->belongsTo('Occurence','source_id','id');
  }

  public function dst(){
    return $this->belongsTo('Occurence','destiny_id','id');
  }

  public function incidents(){
    return $this->belongsTo('Incident','incidents_id','id');
  }

}
