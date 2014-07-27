<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnexesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('annexes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title')->nullable();
			$table->string('field')->nullable();
			$table->longText('content')->nullable();
			$table->integer('incidents_id')->unsigned();
			$table->integer('incident_handler_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::table('annexes',function(Blueprint $table){
			$table->foreign('incidents_id')->references('id')->on('incidents');
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
