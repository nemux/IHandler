<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('log')->create('log', function(Blueprint $table)
		{
			$table->increments('id');
      $table->integer('user_id');
      $table->string('username');
      $table->string('ip');
      $table->string('action');
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
		Schema::connection('log')->drop('log');
	}
}
