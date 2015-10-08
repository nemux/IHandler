<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('person_id'); //FKey
            $table->unsignedInteger('user_type_id'); //Fkey
            $table->string('username');
            $table->string('password');
            $table->boolean('active');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            //FKeys
            $table->foreign('person_id')->references('id')->on('person')->onDelete('cascade');
            $table->foreign('user_type_id')->references('id')->on('user_type')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user');
    }
}
