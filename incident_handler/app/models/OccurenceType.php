<?php

class OccurenceType extends Eloquent {

  /**
   * The database table used by the model.
   * @var string
   */
  use SoftDeletingTrait;

  protected $dates = ['deleted_at'];
  protected $table = 'occurrences_types';
  protected $fillable = ['name','description'];

  /**
   * The attributes excluded from the model's JSON form.
   * @var array
   */


}
