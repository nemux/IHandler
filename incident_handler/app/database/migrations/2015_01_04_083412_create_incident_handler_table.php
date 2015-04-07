<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentHandlerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('incident_handler', function(Blueprint $table)

	{
      $table->increments('id');
      $table->string('name',50);
      $table->string('lastname',50)->nullable();
      $table->string('mail',60);
      $table->string('phone',50)->nullable();
      $table->timestamps();
      $table->softDeletes();
		//
     } );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{		//
		Schema::drop('incident_handler');
	}

}
