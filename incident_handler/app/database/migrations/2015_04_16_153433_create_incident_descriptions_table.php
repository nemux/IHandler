<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentDescriptionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Tabla donde se almacena un historial de las descripciones ingresadas por los incindent handleres.
        Schema::create('incident_descriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('incidents_id')->unsigned();
            $table->integer('incident_handler_id')->unsigned();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('incident_descriptions', function (Blueprint $table) {
            $table->foreign('incidents_id')->references('id')->on('incidents');
            $table->foreign('incident_handler_id')->references('id')->on('incident_handler');
        });
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
