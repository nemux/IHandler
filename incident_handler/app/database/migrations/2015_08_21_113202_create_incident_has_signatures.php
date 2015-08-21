<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIncidentHasSignatures extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents_signatures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('incidents_id')->unsigned();
            $table->integer('signatures_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('incidents_id')->references('id')->on('incidents');
            $table->foreign('signatures_id')->references('id')->on('signatures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('incidents_signatures');
    }

}
