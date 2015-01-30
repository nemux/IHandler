<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tickets',function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('otrs_ticket_id')->unsigned()->nullable();
      $table->string('otrs_ticket_number')->unsigned()->nullable();
      $table->integer('incident_handler_id')->unsigned();
			$table->string('internal_number')->nullable();
			$table->integer('incidents_id')->unsigned();
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
		Schema::drop('tickets');
	}

}
