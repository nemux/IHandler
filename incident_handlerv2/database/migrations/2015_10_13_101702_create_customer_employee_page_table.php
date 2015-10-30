<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerEmployeePageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_employee_page', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('customer_employee_id');
            $table->unsignedInteger('link_id');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_employee_id')->references('id')->on('customer_employee')->onDelete('cascade');
            $table->foreign('link_id')->references('id')->on('link')->onDelete('cascade');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customer_employee_page');
    }
}
