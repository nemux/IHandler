<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRules extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rules',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('sid')->nullable();
			$table->string('rule')->nullable();
			$table->string('message')->nullable();
			$table->string('translate')->nullable();
			$table->string('rule_is')->nullable();
			$table->string('why')->nullable();
			
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
		Schema::drop('rules');
	}

}
