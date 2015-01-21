<?php

class SrcDst extends Eloquent {

  /**
   * The database table used by the model.
   * @var string
   */
  protected $table = 'src_dst';
  protected $fillable = ['src_id','dst_id','incidents_id'];
  protected $softDelete = true;
  /**
   * The attributes excluded from the model's JSON form.
   * @var array
   */

  public function src(){
    return $this->belongsTo('Events','src_id','src');
  }

  public function dst(){
    return $this->belongsTo('Events','dst_id','dst');
  }

  public function incidents(){
    return $this->belongsTo('incidents','incidents_id','id');
  }

}
