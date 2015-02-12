<?php

class ExtraCategory extends Eloquent {


  protected $table = 'extra_category';
  protected $fillable = ['category_id','incidents_id'];

  /**
   * The attributes excluded from the model's JSON form.
   * @var array
   */
  //protected $hidden = array('password', 'remember_token');
  public function incident(){
    return $this->belongsTo('Incident','incidents_id','id');
  }
  public function category(){
    return $this->belongsTo('Category','category_id','id');
  }

}
