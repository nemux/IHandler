<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('extra_category', function(Blueprint $table){

				$table->increments('id');
					$table->integer('incidents_id')->unsigned();
					$table->integer('category_id')->unsigned();
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
