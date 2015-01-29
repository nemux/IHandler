<?php

class Recomendation extends Eloquent {


	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'recomendations';
	protected $fillable = ['content','incidents_id','otrs_article_id'];
	protected $softDelete = true;



}
