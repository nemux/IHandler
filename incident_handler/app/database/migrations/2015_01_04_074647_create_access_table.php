<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//la tabla de acceso desde este lado se realizara el manejor de las sesiones
		Schema::create('access',function(Blueprint $table){

	    $table->increments('id');
      $table->integer('incident_handler_id')->unsigned();
      $table->integer('access_types_id')->unsigned();
      $table->string('username');
      $table->string('password');
      $table->boolean('active');
      $table->rememberToken()->nullable();
      $table->timestamps();
      $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		Schema::drop('access');
	}

}
