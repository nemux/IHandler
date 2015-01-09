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
			$table->string('link')->nullable();
      $table->string('title')->nullable();
			$table->datetime('datetime')->nullable();
			$table->string('cve')->nullable();
			$table->string('cvss')->nullable();
      $table->string('bid')->nullable();
			$table->string('sid')->nullable();
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
