<?php

class AccessType extends Eloquent {

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'access_types';
	protected $fillable = ['name','description'];
	protected $softDelete = true;

	//la notacion estandar es de la siguente manera: la funcion se llama con el nombre de la que la genera y
	//el nombre de la que genera, si es necesario se agregan letras adicionales para evitar la duplicidad
}
