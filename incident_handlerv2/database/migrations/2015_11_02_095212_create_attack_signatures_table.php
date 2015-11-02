<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttackSignaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attack_signature', function (Blueprint $table) {
            $table->increments('id');

            $table->string('signature');
            $table->text('description')->nullable();
            $table->text('recommendation')->nullable();
            $table->text('risk')->nullable();
            $table->text('reference')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attack_signature');
    }
}
