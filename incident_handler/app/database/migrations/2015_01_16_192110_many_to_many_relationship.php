<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ManyToManyRelationship extends Migration {

	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{


		Schema::table('incidents_rules', function(Blueprint $table)
		{
			$table->foreign('incidents_id')->references('id')->on('incidents');
			$table->foreign('rules_id')->references('id')->on('rules');

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
