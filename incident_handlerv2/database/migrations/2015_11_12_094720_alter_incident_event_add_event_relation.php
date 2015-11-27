<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterIncidentEventAddEventRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incident_event', function (Blueprint $table) {
            $table->string('event_relation', '2')->nullable()->default('11');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incident_event', function (Blueprint $table) {
            $table->dropColumn('event_relation');
        });
    }
}
