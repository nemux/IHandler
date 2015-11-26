<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCustomerAssetTableAddAssetForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_asset', function (Blueprint $table) {
            $table->foreign('asset_id')->references('id')->on('asset')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_asset', function (Blueprint $table) {
//            $table->dropForeign('asset_id');
        });
    }
}
