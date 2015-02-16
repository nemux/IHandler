<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTokenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_token', function(Blueprint $table){

					$table->increments('id');
					$table->integer('incident_handler_id')->unsigned();
					$table->string('token');
					$table->timestamps();

			});
		Schema::table('user_token', function(Blueprint $table)
		{
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
