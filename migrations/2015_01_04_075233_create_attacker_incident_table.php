<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttackerIncidentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attacker_incident', function(Blueprint $table)
		{
      $table->increments('id');
      $table->integer('attacker_id')->unsigned();
      $table->integer('incident_id')->unsigned();
		}	);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attacker_incident');
		//
	}

}
