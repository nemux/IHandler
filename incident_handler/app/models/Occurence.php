<?php

class Occurence extends Eloquent {

  /**
   * The database table used by the model.
   * @var string
   */
  protected $table = 'occurrences';
  protected $fillable = ['ip','src','dst'];
  protected $softDelete = true;
  /**
   * The attributes excluded from the model's JSON form.
   * @var array
   */


  public function type(){
    return $this->belongsTo('occurrencesType','occurrences_id','id');
  }

}
