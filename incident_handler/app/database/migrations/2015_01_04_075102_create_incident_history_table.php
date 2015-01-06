<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('incident_history',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('datetime');
            $table->string('descripcion');
            $table->integer('incident__handler_id')->unsigned();
            $table->integer('incident_status_id')->unsigned();
		});
		//Schema::table('incident_history', function(Blueprint $table)
		//{
		//	$table->foreign('incident_history_incident_handler_id')->references('id')->on('incident_handler');
		//	$table->foreign('incident_history_incident_status_id')->references('id')->on('incident_status');
		//});
		//
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('incident_history',function(Blueprint $table)
		{
			$table->dropForeign('incident_history_incident__handler_id_foreign');
			$table->dropForeign('incident_history_incident_status_id_foreign');
		});

		Schema::drop('incident_history');
		//
	}

}
