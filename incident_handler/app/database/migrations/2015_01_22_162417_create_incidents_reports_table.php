<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentsReportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('incident_report', function(Blueprint $table)
		{
			$table->increments('id');
      $table->integer('incidents_id')->unsigned();
      $table->integer('reports_id')->unsigned();
		});

    Schema::table('incident_report', function(Blueprint $table){
      $table->foreign('incidents_id')->references('id')->on('incidents');
      $table->foreign('reports_id')->references('id')->on('reports');
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('incidents_reports');
	}

}
