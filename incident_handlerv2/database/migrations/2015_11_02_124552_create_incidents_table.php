<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->text('description');
            $table->text('recommendation');
            $table->text('reference');

            $table->unsignedInteger('attack_type_id');
            $table->unsignedInteger('criticity_id');

            $table->unsignedInteger('impact');
            $table->unsignedInteger('risk');

            $table->timestamp('detection_time');
            $table->timestamp('occurrence_time');

            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('attack_flow_id');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('attack_type_id')->references('id')->on('attack_type')->onDelete('cascade');
            $table->foreign('criticity_id')->references('id')->on('criticity')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');
            $table->foreign('attack_flow_id')->references('id')->on('attack_flow')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('incident');
    }
}
