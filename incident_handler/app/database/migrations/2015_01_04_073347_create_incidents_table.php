<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//La tabla de incidentes (la migracion de)
		Schema::create('incidents',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('risk')->nullable();
			$table->string('criticity')->nullable();
			$table->string('impact')->nullable();
      $table->string('description')->nullable();
			$table->string('file')->nullable();
			$table->string('conclution');
			$table->string('recomendation');
			$table->integer('categories_id')->unsigned();
			$table->integer('attacks_id')->unsigned();
			$table->integer('customers_id')->unsigned();
			$table->integer('incident_handler_id')->unsigned();
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
		Schema::drop('incidents');
	}

}
