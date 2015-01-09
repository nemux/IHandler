<?php


class Reference extends Eloquent  {


	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'references';
	protected $fillable = ['link','title','date','cve','cvss','bid','sid','incidents_id'];
	protected $softDelete = true;

	public function incident(){
		return $this->belongsTo('Incident','incidents_id','id');
	}

}
