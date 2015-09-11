<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesEvidenceTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages_evidence', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('customer_id')->unsigned();
            $table->integer('pages_id')->unsigned();
            $table->text('file');
            $table->text('name');
            $table->string('footnote')->nullable();
            $table->char('md5', 32)->default('-MD5-');
            $table->char('sha1', 40)->default('-SHA1-');
            $table->char('sha256', 64)->default('-SHA256-');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('pages_id')->references('id')->on('customer_pages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pages_evidence');
    }

}
