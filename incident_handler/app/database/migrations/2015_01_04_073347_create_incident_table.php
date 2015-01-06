<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//La tabla de incidentes (la migracion de)
		Schema::create('incidentes',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('risk');
			$table->string('criticity');
			$table->string('impact');
			$table->string('file');
			$table->string('conclution');
			$table->string('recomendation');
			$table->integer('category_id')->unsigned();
			$table->integer('attack_id')->unsigned();
			$table->integer('customer_id')->unsigned();
			$table->integer('incident_handler_id')->unsigned();
			$table->timestamps();

		});



		//Schema::table('incident', function(Blueprint $table){
		//	$table->foreign('incident_handler_id')->references('id')->on('incident_handler');
		//	$table->foreign('category_id')->references('id')->on('category');
		//	$table->foreign('attack_id')->references('id')->on('attack');
		//	$table->foreign('customer_id')->references('id')->on('customer');
		//});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::table('incident',function(Blueprint $table)
		{
			$table->dropForeign('incident_incident_handler_id_foreign');
			$table->dropForeign('incident_category_id_foreign');
			$table->dropForeign('incident_attack_id_foreign');
			$table->dropForeign('incident_customer_id_foreign');
		});

		Schema::drop('incident');
	}

}
