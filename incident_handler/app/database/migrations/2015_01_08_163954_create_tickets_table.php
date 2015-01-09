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
			$table->integer('otrs_ticket_id')->unsigned();
      $table->integer('otrs_ticket_number')->unsigned();
      $table->datetime('datetime');
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
		Schema::drop('tickets');
	}

}
