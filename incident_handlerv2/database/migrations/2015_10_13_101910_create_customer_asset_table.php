<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerAssetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_asset', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('customer_id');

            $table->string('domain_name')->nullable();
            $table->string('ipv4')->nullable();
            $table->string('ipv6')->nullable();
            $table->text('comments')->nullable();

            $table->timestamps();
            $table->softDeletes();

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
        Schema::drop('customer_asset');
    }
}
