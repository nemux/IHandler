<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();

            $table->string('name');
            $table->string('lastname');
            $table->string('corp_email');
            $table->string('personal_email')->nullable();
            $table->text('socialmedia')->nullable();

            $table->text('comments')->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customer_employees');
    }

}
