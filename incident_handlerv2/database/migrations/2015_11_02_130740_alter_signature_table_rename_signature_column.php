<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSignatureTableRenameSignatureColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attack_signature', function (Blueprint $table) {
            $table->renameColumn('signature', 'name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attack_signature', function (Blueprint $table) {
            $table->renameColumn('name', 'signature');
        });
    }
}
