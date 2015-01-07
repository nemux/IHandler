<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('application',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
            $table->string('description');
            $table->integer('incident_id')->unsigned();
		});
		//Schema::table('application', function(Blueprint $table)
		//{
		//	$table->foreign('application_incident_id')->references('id')->on('incident');
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
		Schema::table('application',function(Blueprint $table)
		{
			$table->dropForeign('application_incident_id_foreign');
		});

		Schema::drop('application');
	
		//
	}

}
