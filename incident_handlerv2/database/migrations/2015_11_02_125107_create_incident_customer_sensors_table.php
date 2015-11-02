<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentCustomerSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident_customer_sensor', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('incident_id');
            $table->unsignedInteger('customer_sensor_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('incident_id')->references('id')->on('incident')->onDelete('cascade');
            $table->foreign('customer_sensor_id')->references('id')->on('customer_sensor')->onDelete('cascade');

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
        Schema::drop('incident_customer_sensor');
    }
}
