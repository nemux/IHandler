<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident_note', function (Blueprint $table) {
            $table->increments('id');

            $table->text('content');

            $table->unsignedInteger('incident_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('read_by')->nullable();
            $table->unsignedInteger('attended_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('incident_id')->references('id')->on('incident')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('read_by')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('attended_by')->references('id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('incident_note');
    }
}
