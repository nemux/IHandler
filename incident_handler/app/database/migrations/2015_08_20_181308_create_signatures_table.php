<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignaturesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('signatures', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('signature');
			$table->text('description')->nullable();
			$table->text('recommendation')->nullable();
			$table->text('reference')->nullable();
			$table->text('risk')->nullable();

//			$table->timestamps();
//			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('signatures');
	}

}
