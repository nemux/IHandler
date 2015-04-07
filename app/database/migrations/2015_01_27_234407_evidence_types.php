<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EvidenceTypes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('evidence_types', function(Blueprint $table){

					$table->increments('id');
					$table->string('name');
					$table->string('description');
					$table->timestamps();
          $table->softDeletes();
			});

			Schema::table("images",function(Blueprint $table){
				$table->foreign('evidence_types_id')->references("id")->on("evidence_types");
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
