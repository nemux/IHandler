<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_employee', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('person_id');
            $table->unsignedInteger('customer_id');

            $table->string('email', 60)->nullable();
            $table->string('phone', 50)->nullable();

            $table->text('comments')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('person_id')->references('id')->on('person')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customer_employee');
    }
}
