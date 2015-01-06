<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('company');
            $table->string('phone');
            $table->string('name');
            $table->string('mail');
            $table->timestamps();
		});
		//
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('customer');
		//
	}

}
