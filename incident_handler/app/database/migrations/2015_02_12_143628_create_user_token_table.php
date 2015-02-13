<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTokenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('extra_category', function(Blueprint $table){

				$table->increments('id');
					$table->integer('handler_id')->unsigned();
					$table->string('token');
					$table->timestamps();

			});
		Schema::table('extra_category', function(Blueprint $table)
		{
			$table->foreign('incidents_id')->references('id')->on('incidents');
			$table->foreign('category_id')->references('id')->on('categories');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
