<?php

class IncidentSignature extends Eloquent{

  /**
   * The database table used by the model.
   * @var string
   */
  use SoftDeletingTrait;

  protected $dates = ['deleted_at'];
  protected $table = 'incidents_signatures';
  protected $fillable = ['incidents_id','signatures_id'];


  public function signature(){
    return $this->belongsTo('Signature','signatures_id','id');
  }


  public function incident(){
    return $this->belongsTo('Incident','incidents_id','id');
  }

}
