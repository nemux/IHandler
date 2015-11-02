<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentAttackCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident_attack_category', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('incident_id');
            $table->unsignedInteger('attack_category_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('incident_id')->references('id')->on('incident')->onDelete('cascade');
            $table->foreign('attack_category_id')->references('id')->on('attack_category')->onDelete('cascade');

            $table->unsignedInteger('user_id');
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
        Schema::drop('incident_attack_category');
    }
}
