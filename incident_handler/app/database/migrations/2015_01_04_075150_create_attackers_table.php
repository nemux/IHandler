<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttackersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attackers',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('ip');
      $table->string('location');
			$table->integer('incidents_id')->unsigned();
      $table->integer('attacker_types_id')->unsigned();
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
		Schema::drop('attackers');
	}

}
