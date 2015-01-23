<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sensors',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('ip')->nullable();
			$table->integer('customers_id')->unsigned();
			$table->string('montage');
			$table->timestamps();

		});
		Schema::table('sensors', function(Blueprint $table)
		{
			$table->foreign('customers_id')->references('id')->on('customers');
		});

		Schema::table('incidents', function(Blueprint $table)
		{
			$table->foreign('sensors_id')->references('id')->on('sensors');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sensors');
	}

}
