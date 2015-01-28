<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('images', function(Blueprint $table){

	  		$table->increments('id');
      		$table->integer('incidents_id')->unsigned();
      		$table->string('source')->nullable();
      		$table->binary('file');
      		$table->string('name');
					$table->integer('evidence_types_id')->unsigned();
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
		Schema::drop('images');
	}

}
