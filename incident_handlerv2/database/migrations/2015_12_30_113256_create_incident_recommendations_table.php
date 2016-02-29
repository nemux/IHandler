<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIncidentRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident_recommendation', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('incident_id');
            $table->unsignedInteger('user_id');

            $table->string('otrs_article_id')->nullable();

            $table->text('content');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('incident_id')->references('id')->on('incident')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('incident_recommendation');
    }
}
