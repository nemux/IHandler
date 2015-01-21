<?php


class Sensor extends Eloquent  {


  /**
   * The database table used by the model.
   * @var string
   */
  protected $table = 'sensors';
  protected $fillable = ['ip','name','customers_id','montage'];
  protected $softDelete = true;


  public function customers()
  {
    return $this->belongsTo('Customer','customers_id','id');
  }
}
