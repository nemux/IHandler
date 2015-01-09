<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttackersHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attackers_history',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('port');
      $table->string('protocol');
      $table->string('operative_system');
      $table->string('function');
      $table->datetime('datetime');
      $table->integer('attackers_id')->unsigned();
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
		Schema::drop('attackers_history');
	}

}
