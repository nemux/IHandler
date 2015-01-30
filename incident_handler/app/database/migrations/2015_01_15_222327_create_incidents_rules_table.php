<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentsRulesTable extends Migration {

	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('incidents_rules', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('rules_id')->unsigned();
			$table->integer('incidents_id')->unsigned();
			$table->timestamps();
      $table->softDeletes();
		}	);
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
	{
		Schema::drop('incidents_rules');
	}

}
