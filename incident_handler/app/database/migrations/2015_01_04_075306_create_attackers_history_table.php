<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttackersHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events_history',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('port')->nullable();
      $table->string('protocol')->nullable();
      $table->string('operative_system')->nullable();
      $table->string('function')->nullable();
      $table->string('location')->nullable();
      $table->datetime('datetime')->nullable();
      $table->integer('events_id')->unsigned();
      $table->integer('incident_handler_id')->unsigned();
      $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attackers_history');
	}

}
