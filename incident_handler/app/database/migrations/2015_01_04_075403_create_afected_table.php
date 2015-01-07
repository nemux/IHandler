<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAfectedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('afected',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('source');
            $table->string('datetime');
            $table->integer('incident_id')->unsigned();
            $table->integer('afected_id')->unsigned();
		});
		//Schema::table('afected', function(Blueprint $table)
		//{
		//	$table->foreign('afected_incident_id')->references('id')->on('incident');
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
		Schema::table('afected',function(Blueprint $table)
		{
			$table->dropForeign('afected_incident_id_foreign');
		});

		Schema::drop('afected');
		//
	}

}
