<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttackersIncidentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attackers_incidents', function(Blueprint $table)
		{
      $table->increments('id');
      $table->integer('attackers_id')->unsigned();
      $table->integer('incidents_id')->unsigned();
		}	);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attackers_incidents');
	}

}
