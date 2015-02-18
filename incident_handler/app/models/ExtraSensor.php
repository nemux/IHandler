<?php

class ExtraSensor extends Eloquent {


  protected $table = 'extra_sensor';
  protected $fillable = ['sensor_id','incidents_id'];

  /**
   * The attributes excluded from the model's JSON form.
   * @var array
   */
  //protected $hidden = array('password', 'remember_token');
  public function incident(){
    return $this->belongsTo('Incident','incidents_id','id');
  }
  public function sensor(){
    return $this->belongsTo('Sensor','sensor_id','id');
  }

}
