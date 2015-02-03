<?php

class Observation extends Eloquent {


  /**
   * The database table used by the model.
   * @var string
   */
  use SoftDeletingTrait;

  protected $dates = ['deleted_at'];
  protected $table = 'observations';
  protected $fillable = ['content','incidents_id','incident_handler_id'];

}
