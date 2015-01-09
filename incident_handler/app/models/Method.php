<?php



class Method extends Eloquent {

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'methods';
	protected $fillable = ['name','description','incidents_id'];
	protected $softDelete = true;

	public function incident(){
		return $this->belongsTo('Incident','incidents_id','id');
	}

}
