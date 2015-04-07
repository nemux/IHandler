<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraSensorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('extra_sensor', function(Blueprint $table){

				$table->increments('id');
					$table->integer('incidents_id')->unsigned();
					$table->integer('sensor_id')->unsigned();
					$table->timestamps();

			});
			Schema::table('extra_sensor', function(Blueprint $table)
			{
				$table->foreign('incidents_id')->references('id')->on('incidents');
				$table->foreign('sensor_id')->references('id')->on('sensors');
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
