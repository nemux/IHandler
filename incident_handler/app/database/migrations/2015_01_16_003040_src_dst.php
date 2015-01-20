<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SrcDst extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up()
	{
		
			Schema::create('src_dst',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('src_id')->unsigned();
      $table->string('dst_id')->unsigned();
	    $table->integer('incidents_id')->unsigned();
      $table->timestamps();
		});
		
		//
	}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('src_dst');
		//
	}

}
