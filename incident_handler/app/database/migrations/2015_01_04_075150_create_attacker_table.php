<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttackerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attacker',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('ip');
            $table->string('location');
			$table->integer('incident_id')->unsigned();
            $table->integer('attacker_type_id')->unsigned();
            $table->timestamps();
		});
		//Schema::table('attacker', function(Blueprint $table)
		//{
		//	$table->foreign('incident_id')->references('id')->on('incident');
		//	$table->foreign('attacker_type_id')->references('id')->on('attacker_type_id');
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
		Schema::table('attacker',function(Blueprint $table)
		{
			$table->dropForeign('attacker_incident_id_foreign');
			$table->dropForeign('attacker_attacker_type_id_foreign');
		});
		Schema::drop('attacker');

		//
	}

}
