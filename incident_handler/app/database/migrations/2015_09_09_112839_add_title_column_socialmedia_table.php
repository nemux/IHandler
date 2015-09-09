<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTitleColumnSocialmediaTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_socialmedia', function (Blueprint $table) {
            $table->string('title', 255)->after('customer_id')->default('[[TITLE]]');
            $table->integer('criticity_id')->after('customer_id')->unsigned()->default(3);

            $table->foreign('criticity_id')->references('id')->on('criticity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_socialmedia', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('criticity_id');
        });
    }

}
