<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Relaciones extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('incident', function(Blueprint $table){
			$table->foreign('incident_handler_id')->references('id')->on('incident_handler');
			$table->foreign('category_id')->references('id')->on('category');
			$table->foreign('attack_id')->references('id')->on('attack');
			$table->foreign('customer_id')->references('id')->on('customer');
		});
		Schema::table('acces', function(Blueprint $table){
			$table->foreign('incident_handler_id')->references('id')->on('incident_handler');
			$table->foreign('acces_type_id')->references('id')->on('acces_type');
		});

		Schema::table('attacker', function(Blueprint $table)
		{
			$table->foreign('incident_id')->references('id')->on('incident');
			$table->foreign('attacker_type_id')->references('id')->on('attacker_type');
		});
		Schema::table('attacker_history', function(Blueprint $table)
		{
			$table->foreign('attacker_id')->references('id')->on('attacker');
			$table->foreign('incident_handler_id')->references('id')->on('incident_handler');
		});
		Schema::table('afected', function(Blueprint $table)
		{
			$table->foreign('incident_id')->references('id')->on('incident');
		});
		Schema::table('time', function(Blueprint $table)
		{
			$table->foreign('time_type_id')->references('id')->on('time_types');
			$table->foreign('incident_id')->references('id')->on('incident');
		});
		Schema::table('image', function(Blueprint $table){
			$table->foreign('incident_id')->references('id')->on('incident');
		});
		Schema::table('references', function(Blueprint $table)
		{
			$table->foreign('incident_id')->references('id')->on('incident');
		});
		Schema::table('application', function(Blueprint $table)
		{
			$table->foreign('incident_id')->references('id')->on('incident');
		});
		Schema::table('method', function(Blueprint $table)
		{
			$table->foreign('incident_id')->references('id')->on('incident');
		});

				Schema::table('incident_history', function(Blueprint $table)
		{
			$table->foreign('incident_handler_id')->references('id')->on('incident_handler');
			$table->foreign('incident_status_id')->references('id')->on('incident_status');
		});


		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
			Schema::table('incident',function(Blueprint $table)
		{
			$table->dropForeign('incident_incident_handler_id_foreign');
			$table->dropForeign('incident_category_id_foreign');
			$table->dropForeign('incident_attack_id_foreign');
			$table->dropForeign('incident_customer_id_foreign');
		});
			Schema::table('acces',function(Blueprint $table)
		{
			$table->dropForeign('acces_incident_handler_id_foreign');
			$table->dropForeign('acces_acces_type_id_foreign');
		});

			Schema::table('incident_history',function(Blueprint $table)
		{
			$table->dropForeign('incident_history_incident__handler_id_foreign');
			$table->dropForeign('incident_history_incident_status_id_foreign');
		});	
			Schema::table('attacker',function(Blueprint $table)
		{
			$table->dropForeign('attacker_incident_id_foreign');
			$table->dropForeign('attacker_attacker_type_id_foreign');
		});
			Schema::table('attacker_history',function(Blueprint $table)
		{
			$table->dropForeign('attacker_history_attacker_id_foreign');
			$table->dropForeign('attacker_history_incident_handler_id_foreign');
		});
			Schema::table('afected',function(Blueprint $table)
		{
			$table->dropForeign('afected_incident_id_foreign');
		});
			Schema::table('time',function(Blueprint $table)
		{
			$table->dropForeign('time_time_type_id_foreign');
			$table->dropForeign('time_incident_id_foreign');
		});
			Schema::table('image',function(Blueprint $table)
		{
			$table->dropForeign('image_incident_id_foreign');
		});
			Schema::table('references',function(Blueprint $table)
		{
			$table->dropForeign('references_incident_id_foreign');
		});
			Schema::table('application',function(Blueprint $table)
		{
			$table->dropForeign('application_incident_id_foreign');
		});
			Schema::table('method',function(Blueprint $table)
		{
			$table->dropForeign('method_incident_id_foreign');
		});

	
	}

}
