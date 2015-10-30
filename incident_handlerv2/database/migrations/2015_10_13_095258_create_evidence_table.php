<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvidenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidence', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('evidence_type_id');

            $table->string('mime_type');
            $table->string('path');
            $table->string('name');
            $table->string('original_name');
            $table->string('note')->nullable();
            $table->string('md5', 32)->nullable();
            $table->string('sha1', 40)->nullable();
            $table->string('sha256', 64)->nullable();


            $table->timestamps();
            $table->softDeletes();


            $table->foreign('evidence_type_id')->references('id')->on('evidence_type')->onDelete('cascade');

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
        Schema::drop('evidence');
    }
}
