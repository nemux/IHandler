<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Events extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema::create('events',function(Blueprint $table)
		{
			
			$table->increments('id');
			$table->string('ip');
			$table->string('src')->unique();
			$table->string('dst')->unique();
      $table->string('location');
	    $table->integer('attacker_types_id')->unsigned();
	    $table->integer('events_types_id')->unsigned();
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
		Schema::drop('events');
		//
	}

}
