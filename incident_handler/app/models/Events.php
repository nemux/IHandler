<?php

class Events extends Eloquent {

  /**
   * The database table used by the model.
   * @var string
   */
  protected $table = 'events';
  protected $fillable = ['ip','src','dst','location'];
  protected $softDelete = true;
  /**
   * The attributes excluded from the model's JSON form.
   * @var array
   */

  public function incident(){
    return $this->belongsTo('Incident','incidents_id','id');
  }

  public function events(){
    return $this->belongsTo('Events','events_id','id');
  }

}
