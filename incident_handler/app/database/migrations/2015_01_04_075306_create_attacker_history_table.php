<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttackerHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attacker_history',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('port');
            $table->string('protocol');
            $table->string('operative_system');
            $table->string('function');
            $table->string('date');
            $table->integer('attacker_id')->unsigned();
            $table->integer('incident_handler_id')->unsigned();
            $table->timestamps();
		});
		//Schema::table('attacker_history', function(Blueprint $table)
		//{
		//	$table->foreign('attacker_history_attacker_id')->references('id')->on('attacker');
		//	$table->foreign('attacker_history_incident_handler_id')->references('id')->on('incident_handler');
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
		Schema::table('attacker_history',function(Blueprint $table)
		{
			$table->dropForeign('attacker_history_attacker_id_foreign');
			$table->dropForeign('attacker_history_incident_handler_id_foreign');
		});
		Schema::drop('attacker_hisotry');

		//
	}

}
