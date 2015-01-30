<?php


class Rule extends Eloquent  {


  /**
   * The database table used by the model.
   * @var string
   */
  use SoftDeletingTrait;

  protected $dates = ['deleted_at'];
  protected $table = 'rules';
  protected $fillable = ['sid','rule','message','translate','rule_is','why'];



  public function incidents()
  {
    return $this->belongsToMany('Incident','incidents_rules','rules_id','incidents_id');
  }
}
