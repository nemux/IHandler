<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccesPrivilegeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('acces_privilege', function(Blueprint $table)
		{
      $table->increments('id');
      $table->integer('acces_type_id')->unsigned();
      $table->integer('privilege_id')->unsigned();
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
		Schema::drop('acces_privilege');
		//
	}

}
