<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerSensorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_sensor', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('ipv4');
            $table->string('ipv6')->nullable();
            $table->string('mount_point')->nullable();
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('user_id');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');
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
        Schema::drop('customer_sensor');
    }
}
