<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('link_type_id');

            $table->string('title')->nullable();
            $table->text('link');
            $table->text('comments')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('link_type_id')->references('id')->on('link_type')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('link');
    }
}
