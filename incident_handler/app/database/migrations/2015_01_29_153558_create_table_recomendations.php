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
      $table->longText('content')->nullable();
      $table->integer('incidents_id')->unsigned();
      $table->string('otrs_article_id')->nullable();
      $table->timestamps();
      $table->softDeletes();
		});

    Schema::table('recomendations',function(Blueprint $table){
      $table->foreign('incidents_id')->references('id')->on('incidents');
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
