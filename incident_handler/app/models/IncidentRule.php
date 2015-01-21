<?php

class IncidentRule extends Eloquent{

  /**
   * The database table used by the model.
   * @var string
   */
  protected $table = 'incidents_rules';
  protected $fillable = ['incidents_id','rules_id'];
  protected $softDelete = true;

  public function rules(){
    return $this->belongsTo('Rule','rules_id','id');
  }


  public function incidents(){
    return $this->belongsTo('Incident','incidents_id','id');
  }

}
