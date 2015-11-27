<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('otrs_ticket_id')->nullable();
            $table->string('otrs_ticket_number')->nullable();
            $table->string('internal_number')->nullable();
            $table->boolean('send_reminder')->default(FALSE)->nullable();

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('incident_id');
            $table->unsignedInteger('ticket_status_id')->default(1);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('incident_id')->references('id')->on('incident')->onDelete('cascade');
            $table->foreign('ticket_status_id')->references('id')->on('ticket_status')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ticket');
    }
}
