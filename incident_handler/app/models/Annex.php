<?php

class Annex extends Eloquent {


  /**
   * The database table used by the model.
   * @var string
   */
  use SoftDeletingTrait;

  protected $dates = ['deleted_at'];
  protected $table = 'annexes';
  protected $fillable = ['title','field','content','incidents_id','incident_handler_id'];

}
