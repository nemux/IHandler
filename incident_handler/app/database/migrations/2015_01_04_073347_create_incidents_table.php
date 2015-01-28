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
			$table->string('title')->nullable();
			$table->string('risk')->nullable();
			$table->string('criticity')->nullable();
			$table->string('impact')->nullable();
      $table->longText('description')->nullable();
			$table->string('file')->nullable();
			$table->longText('conclution');
			$table->longText('recomendation');
			$table->integer('categories_id')->unsigned();

			$table->integer('attacks_id')->unsigned();
			$table->integer('customers_id')->unsigned();
			$table->string('stream')->nullable();
			$table->integer('incidents_status_id')->unsigned();
			$table->integer('incident_handler_id')->unsigned();
			$table->integer('sensors_id')->unsigned();
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
