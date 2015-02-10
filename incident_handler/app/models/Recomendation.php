<?php

class Recomendation extends Eloquent {


	/**
	 * The database table used by the model.
	 * @var string
	 */
  use SoftDeletingTrait;

        protected $dates = ['deleted_at'];
	protected $table = 'recomendations';
	protected $fillable = ['content','incidents_id','otrs_article_id'];




}
