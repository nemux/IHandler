<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessPrivilegesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('access_privileges', function(Blueprint $table)
		{
      $table->increments('id');
      $table->integer('access_types_id')->unsigned();
      $table->integer('privileges_id')->unsigned();
		}	);
		//
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('access_privilege');
		//
	}

}
