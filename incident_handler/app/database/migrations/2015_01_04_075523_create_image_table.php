<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('image', function(Blueprint $table){

	  		$table->increments('id');
      		$table->integer('incident_id')->unsigned();
      		$table->string('source');
      		$table->binary('file');
      		$table->string('name');
        	$table->timestamps();
			});
		//
	//Schema::table('image', function(Blueprint $table){
	//		$table->foreign('incident_id')->references('id')->on('incident');
	//	});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('image',function(Blueprint $table)
		{
			$table->dropForeign('image_incident_id_foreign');
		});
		Schema::drop('image');
		//
	}

}
