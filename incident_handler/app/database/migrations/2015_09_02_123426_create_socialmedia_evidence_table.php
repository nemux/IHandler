<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSocialmediaEvidenceTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socialmedia_evidence', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->integer('socialmedia_id')->unsigned();
            $table->text('file');
            $table->text('name');
            $table->string('footnote')->nullable();
            $table->char('md5', 32)->default('-MD5-');
            $table->char('sha1', 40)->default('-SHA1-');
            $table->char('sha256', 64)->default('-SHA256-');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('socialmedia_id')->references('id')->on('socialmedia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('socialmedia_evidence');
    }

}
