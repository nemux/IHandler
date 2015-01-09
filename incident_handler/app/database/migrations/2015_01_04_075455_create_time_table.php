<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('time',function(Blueprint $table)
		{
			$table->increments('id');
			$table->datetime('datetime');
      $table->string('zone');
			$table->integer('time_types_id')->unsigned();
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
		Schema::drop('time');
	}

}
