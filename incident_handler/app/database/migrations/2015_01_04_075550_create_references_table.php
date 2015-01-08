<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('references',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('link');
      $table->string('title');
			$table->string('date');
			$table->string('cve');
			$table->string('cvss');
      $table->string('bid');
			$table->string('sid');
      $table->integer('incidents_id')->unsigned();
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
		Schema::drop('references');
	}

}
