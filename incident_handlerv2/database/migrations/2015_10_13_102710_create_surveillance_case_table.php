<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveillanceCaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveillance_case', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('criticity_id');

            $table->string('title');
            $table->text('description');
            $table->text('recommendation');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('criticity_id')->references('id')->on('criticity')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('surveillance_case');
    }
}
