<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifications',function(Blueprint $table)
		{

			$table->increments('id');
			$table->longtext('content');
	    	$table->integer('incident_handler_id')->unsigned();
			$table->integer('relevance')->default("0");
      		$table->timestamps();
      		$table->foreign('incident_handler_id')->references('id')->on('incident_handler');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
