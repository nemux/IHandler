<?php

class IncidentHandlerToken extends Eloquent {

  /**
   * The database table used by the model.
   * @var string
   */

  protected $table = 'user_token';
  protected $fillable = ['token','incident_handler_id'];

  /**
   * The attributes excluded from the model's JSON form.
   * @var array
   */
  //protected $hidden = array('password', 'remember_token');
  public function handler(){
    return $this->belongsTo('IncidentHandler','incident_handler_id','id');
  }


}
