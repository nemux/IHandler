<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EventsType extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema::create('occurrences_types',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
      $table->string('description');
		  $table->timestamps();
      $table->softDeletes();
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
		Schema::drop('events_types');
		//
	}

}

