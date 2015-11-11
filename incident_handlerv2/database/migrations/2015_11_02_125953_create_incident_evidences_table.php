<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentEvidencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident_evidence', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('incident_id');
            $table->unsignedInteger('evidence_id');

            $table->string('note')->nullable();

            $table->unsignedInteger('user_id');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('incident_id')->references('id')->on('incident')->onDelete('cascade');
            $table->foreign('evidence_id')->references('id')->on('evidence')->onDelete('cascade');
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
        Schema::drop('incident_evidence');
    }
}
