<?php



class Method extends Eloquent {

	/**
	 * The database table used by the model.
	 * @var string
	 */
  use SoftDeletingTrait;

  protected $dates = ['deleted_at'];
	protected $table = 'methods';
	protected $fillable = ['name','description','incidents_id'];


	public function incident(){
		return $this->belongsTo('Incident','incidents_id','id');
	}

}
