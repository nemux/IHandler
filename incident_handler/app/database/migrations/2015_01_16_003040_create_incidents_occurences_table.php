<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentsOccurencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up()
	{

			Schema::create('incidents_occurences',function(Blueprint $table)
		{
			$table->increments('id');
	    $table->integer('source_id')->unsigned();
			$table->integer('destiny_id')->unsigned();
			$table->integer('incidents_id')->unsigned();
      $table->timestamps();
		});

		//
	}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('incidents_occurences');
		//
	}

}
