<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident_event', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('incident_id');
            $table->unsignedInteger('source_machine_id');
            $table->unsignedInteger('target_machine_id');
            $table->text('payload')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('incident_id')->references('id')->on('incident')->onDelete('cascade');
            $table->foreign('source_machine_id')->references('id')->on('machine')->onDelete('cascade');
            $table->foreign('target_machine_id')->references('id')->on('machine')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('incident_event');
    }
}
