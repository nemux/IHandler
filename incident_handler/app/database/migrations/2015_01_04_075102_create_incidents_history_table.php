<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentsHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('incidents_history',function(Blueprint $table)
		{
			$table->increments('id');
			$table->datetime('datetime');
      $table->string('description');
      $table->integer('incidents_id')->unsigned();
      $table->integer('incident_handler_id')->unsigned();
      $table->integer('incidents_status_id')->unsigned();
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
		Schema::drop('incidents_history');
	}

}
