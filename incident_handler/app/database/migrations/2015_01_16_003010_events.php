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
			Schema::create('occurrences',function(Blueprint $table)
		{

			$table->increments('id');
			$table->string('ip');
	    $table->integer('occurrences_types_id')->unsigned();
			$table->boolean('blacklist')->default("0");
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
		Schema::drop('occurrences');
		//
	}

}
