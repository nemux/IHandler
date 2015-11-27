<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveillanceCaseEvidenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveillance_case_evidence', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('surveillance_case_id');
            $table->unsignedInteger('evidence_id');

            $table->string('note');

            $table->unsignedInteger('user_id');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('surveillance_case_id')->references('id')->on('surveillance_case')->onDelete('cascade');
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
        Schema::drop('surveillance_case_evidence');
    }
}
