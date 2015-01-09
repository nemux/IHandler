<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tickets_history',function(Blueprint $table)
		{
			$table->increments('id');
      $table->datetime('datetime');
      $table->integer('incident_handler_id')->unsigned();
     	$table->integer('tickets_status_id')->unsigned();
     	$table->integer('tickets_id')->unsigned();
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
		Schema::drop('tickets_history');
	}

}
