<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */


	public function up()
	{
        DB::connection('log')->statement('ALTER TABLE log ALTER COLUMN action TYPE TEXT');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	}
}
