<?php

class Occurence extends Eloquent {

  /**
   * The database table used by the model.
   * @var string
   */

  protected $table = 'occurrences';
  protected $fillable = ['ip','src','dst','occurrences_types_id','blacklist','show', 'location'];

  /**
   * The attributes excluded from the model's JSON form.
   * @var array
   */


  public function type(){
    return $this->belongsTo('OccurenceType','occurrences_types_id','id');
  }



}
