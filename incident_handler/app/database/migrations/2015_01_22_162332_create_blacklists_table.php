<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlacklistsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blacklists', function(Blueprint $table)
		{
			$table->increments('id');
      $table->string('ip');
      $table->string('country');
      $table->integer('incidents_id')->unsigned();
		});

    Schema::table('blacklists',function(Blueprint $table){

      $table->foreign('incidents_id')->references('id')->on('incidents');
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('blacklists');
	}

}
