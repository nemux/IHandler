<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('company')->nullable();
      $table->string('phone')->nullable();
      $table->string('name');
      $table->string('mail');
      $table->string('otrs_userID');
      $table->string('otrs_userlogin');
      $table->string('otrs_usercustomerID');
      $table->string('otrs_validID');
      $table->timestamps();
      $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('customers');
		//
	}

}
