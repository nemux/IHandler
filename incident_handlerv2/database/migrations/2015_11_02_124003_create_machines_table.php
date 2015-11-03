<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine', function (Blueprint $table) {
            $table->increments('id');

            $table->string('ipv4');
            $table->string('ipv6')->nullable();
            $table->string('mac')->nullable();
            $table->string('os')->nullable();
            $table->string('port');
            $table->string('protocol');
            $table->boolean('hide')->default(false);
            $table->boolean('blacklist')->default(false);
            $table->unsignedInteger('location_id')->nullable();
            $table->unsignedInteger('machine_type_id');

            $table->foreign('location_id')->references('id')->on('location')->onDelete('cascade');
            $table->foreign('machine_type_id')->references('id')->on('machine_type')->onDelete('cascade');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('machine');
    }
}
