<?php


class Rule extends Eloquent  {


  /**
   * The database table used by the model.
   * @var string
   */
  protected $table = 'rules';
  protected $fillable = ['sid','rule','message','translate','is','why','incidents_id'];
  protected $softDelete = true;

  public function incident(){
    return $this->belongsTo('Incident','incidents_id','id');
  }

}
