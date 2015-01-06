<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMethodTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('method',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
            $table->string('description');
            $table->integer('incident_id')->unsigned();
		});
		//Schema::table('method', function(Blueprint $table)
		//{
		//	$table->foreign('method_incident_id')->references('id')->on('incident');
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
		Schema::table('method',function(Blueprint $table)
		{
			$table->dropForeign('method_incident_id_foreign');
		});

		Schema::drop('method');
	
		//
	}

}
