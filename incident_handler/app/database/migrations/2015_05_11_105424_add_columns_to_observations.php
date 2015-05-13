<?php

use Illuminate\Database\Migrations\Migration;

class AddColumnsToObservations extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('observations', function ($table) {
//            $table->integer('created_by')->nullable();
//            $table->integer('readed')->nullable();
//            $table->integer('attend')->nullable();
//            $table->foreign('created_by')->references('id')->on('incident_handler');
//            $table->foreign('incident_handler_id')->references('id')->on('incident_handler');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

}
