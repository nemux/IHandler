<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffectedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('affected',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('source');
      $table->datetime('datetime');
      $table->integer('incidents_id')->unsigned();
      $table->integer('affected_types_id')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('affected');
	}

}
