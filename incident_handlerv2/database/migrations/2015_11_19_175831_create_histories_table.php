<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident_history', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('incident_id');
            $table->unsignedInteger('user_id');

            $table->string('title')->nullable();
            $table->text('categories')->nullable();
            $table->timestamp('occurrence_time')->nullable();
            $table->timestamp('detection_time')->nullable();
            $table->string('attack_flow')->nullable();
            $table->string('attack_type')->nullable();
            $table->string('criticity')->nullable();
            $table->unsignedInteger('impact')->nullable();
            $table->unsignedInteger('risk')->nullable();
            $table->string('customer_name')->nullable();
            $table->text('sensors')->nullable();
            $table->text('signatures')->nullable();
            $table->text('events')->nullable();
            $table->text('description')->nullable();
            $table->text('recommendation')->nullable();
            $table->text('reference')->nullable();
            $table->text('evidences')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('incident_id')->references('id')->on('incident')->onDelete('cascade');
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
        Schema::drop('incident_history');
    }
}
