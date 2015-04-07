<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reports', function(Blueprint $table)
		{
			$table->increments('id');
      $table->integer('customers_id')->unsigned();
      $table->timestamps();
      $table->softDeletes();
		});

    Schema::table('reports', function(Blueprint $table){

      $table->foreign('customers_id')->references('id')->on('customers');
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reports');
	}

}
