<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRecomendations extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recomendations', function(Blueprint $table)
		{
			$table->increments('id');
      $table->longText('content');
      $table->integer('incidents_id')->unsigned();
      $table->string('otrs_article_id');
		});

    Schema::table('recomendations',function(Blueprint $table){
      $table->foreign('incidents_id')->references('incidents')->on('id');
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('recomendations');
	}

}
