<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('references',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('link');
            $table->string('title');
			$table->string('date');
			$table->string('cve');
			$table->string('cvss');
            $table->string('bid');
			$table->string('sid');
            $table->integer('incident_id')->unsigned();
            $table->timestamps();
		});
		//Schema::table('reference', function(Blueprint $table)
		//{
		//	$table->foreign('incident_id')->references('id')->on('incident');
		//});
		//
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('references',function(Blueprint $table)
		{
			$table->dropForeign('references_incident_id_foreign');
		});
		Schema::drop('references');
		//
	}

}
