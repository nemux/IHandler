<?php


class Application extends Eloquent {

	/**
	 * The database table used by the model.
	 * @var string
	 */
  use SoftDeletingTrait;

  protected $dates = ['deleted_at'];
	protected $table = 'applications';
	protected $fillable = ['name','description','incidents_id'];


	public function affected(){
		return $this->belongsTo('Incident','incidents_id','id');
	}

}
