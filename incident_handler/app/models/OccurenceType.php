<?php

class OccurenceType extends Eloquent {

  /**
   * The database table used by the model.
   * @var string
   */
  protected $table = 'occurrences_types';
  protected $fillable = ['name','description'];
  protected $softDelete = true;
  /**
   * The attributes excluded from the model's JSON form.
   * @var array
   */


}
