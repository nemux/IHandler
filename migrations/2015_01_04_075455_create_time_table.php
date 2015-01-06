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
		//
		Schema::create('time',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('datetime');
            $table->string('zone');
			$table->integer('time_type_id')->unsigned();
            $table->integer('incident_id')->unsigned();
            $table->timestamps();
		});
		//Schema::table('time', function(Blueprint $table)
		//{
		//	$table->foreign('time_type_id')->references('id')->on('time_type');
		//	$table->foreign('incident_id')->references('id')->on('incident');
		//});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('time',function(Blueprint $table)
		{
			$table->dropForeign('time_time_type_id_foreign');
			$table->dropForeign('time_incident_id_foreign');
		});
		Schema::drop('time');

		//
	}

}
