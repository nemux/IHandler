<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

		//
		 public function up()
  {
    Schema::create('users', function(Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->string('lastname');
      $table->string('mail');
      $table->string('phone');
      $table->integer('type');
      $table->string('other');
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
		Schema::drop('users');
	}

}
