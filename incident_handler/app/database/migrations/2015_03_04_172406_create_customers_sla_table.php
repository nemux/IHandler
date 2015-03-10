<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersSlaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers_sla',function(Blueprint $table){
            $table->increments('id');
            $table->integer('customers_id')->unsigned();
            $table->integer('reminder_low')->default(24);
            $table->integer('close_low')->default(48);
            $table->integer('reminder_medium')->default(120);
            $table->integer('close_medium')->default(168);
            $table->integer('reminder_high')->default(240);
            $table->integer('close_high')->default(312);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('customers_sla',function(Blueprint $table){
            $table->foreign('customers_id')->references('id')->on('customers');
        });
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