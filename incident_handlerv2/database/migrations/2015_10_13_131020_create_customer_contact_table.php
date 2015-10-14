<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_contact', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('person_id');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');
            $table->foreign('person_id')->references('id')->on('person')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customer_contact');
    }
}
