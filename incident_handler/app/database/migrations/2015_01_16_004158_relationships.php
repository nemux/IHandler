<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Relationships extends Migration {

        public function up()
        {
          Schema::table('incidents', function(Blueprint $table)
          {
            $table->foreign('incident_handler_id')->references('id')->on('incident_handler');
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->foreign('attacks_id')->references('id')->on('attacks');
            $table->foreign('customers_id')->references('id')->on('customers');
          });

          Schema::table('access', function(Blueprint $table){
            $table->foreign('incident_handler_id')->references('id')->on('incident_handler');
            $table->foreign('access_types_id')->references('id')->on('access_types');
          });

          Schema::table('occurrences', function(Blueprint $table)
          {
            $table->foreign('occurrences_types_id')->references('id')->on('occurrences_types');
          });

          Schema::table('events_history', function(Blueprint $table)
          {
            $table->foreign('events_id')->references('id')->on('occurrences');
            $table->foreign('incident_handler_id')->references('id')->on('incident_handler');
          });


          Schema::table('time', function(Blueprint $table)
          {
            $table->foreign('time_types_id')->references('id')->on('time_types');
            $table->foreign('incidents_id')->references('id')->on('incidents');
          });

          Schema::table('images', function(Blueprint $table)
          {
            $table->foreign('incidents_id')->references('id')->on('incidents');
          });

          Schema::table('references', function(Blueprint $table)
          {
            $table->foreign('incidents_id')->references('id')->on('incidents');
          });

          Schema::table('applications', function(Blueprint $table)
          {
            $table->foreign('incidents_id')->references('id')->on('incidents');
          });

          Schema::table('methods', function(Blueprint $table)
          {
            $table->foreign('incidents_id')->references('id')->on('incidents');
          });

          Schema::table('tickets', function(Blueprint $table)
          {
            $table->foreign('incident_handler_id')->references('id')->on('incident_handler');
          });

          Schema::table('tickets_history', function(Blueprint $table)
          {
            $table->foreign('incident_handler_id')->references('id')->on('incident_handler');
            $table->foreign('tickets_id')->references('id')->on('tickets');
            $table->foreign('tickets_status_id')->references('id')->on('tickets_status');
          });

          Schema::table('incidents_history', function(Blueprint $table)
          {
            $table->foreign('incident_handler_id')->references('id')->on('incident_handler');
            $table->foreign('incidents_status_id')->references('id')->on('incidents_status');
          });

          Schema::table('src_dst', function (Blueprint $table)
          {
            $table->foreign('src_id')->references('src')->on('occurrences');
            $table->foreign('dst_id')->references('dst')->on('occurrences');
            $table->foreign('incidents_id')->references('id')->on('incidents');
              # code...
            });
          }
        

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
          /*
                        Schema::table('incidents',function(Blueprint $table)
                {
                        $table->dropForeign('incident_incident_handler_id_foreign');
                        $table->dropForeign('incident_category_id_foreign');
                        $table->dropForeign('incident_attack_id_foreign');
                        $table->dropForeign('incident_customer_id_foreign');
                });
                        Schema::table('acces',function(Blueprint $table)
                {
                        $table->dropForeign('acces_incident_handler_id_foreign');
                        $table->dropForeign('acces_acces_type_id_foreign');
                });

                        Schema::table('incident_history',function(Blueprint $table)
                {
                        $table->dropForeign('incident_history_incident__handler_id_foreign');
                        $table->dropForeign('incident_history_incident_status_id_foreign');
                });
                        Schema::table('attacker',function(Blueprint $table)
                {
                        $table->dropForeign('attacker_incident_id_foreign');
                        $table->dropForeign('attacker_attacker_type_id_foreign');
                });
                        Schema::table('attacker_history',function(Blueprint $table)
                {
                        $table->dropForeign('attacker_history_attacker_id_foreign');
                        $table->dropForeign('attacker_history_incident_handler_id_foreign');
                });
                        Schema::table('afected',function(Blueprint $table)
                {
                        $table->dropForeign('afected_incident_id_foreign');
                });
                        Schema::table('time',function(Blueprint $table)
                {
                        $table->dropForeign('time_time_type_id_foreign');
                        $table->dropForeign('time_incident_id_foreign');
                });
                        Schema::table('image',function(Blueprint $table)
                {
                        $table->dropForeign('image_incident_id_foreign');
                });
                        Schema::table('references',function(Blueprint $table)
                {
                        $table->dropForeign('references_incident_id_foreign');
                });
                        Schema::table('application',function(Blueprint $table)
                {
                        $table->dropForeign('application_incident_id_foreign');
                });
                        Schema::table('method',function(Blueprint $table)
                {
                        $table->dropForeign('method_incident_id_foreign');
                });

                Schema::table('tickets', function(Blueprint $table)
                {
                        $table->dropForeign('incident_handler_id');
                });
                Schema::table('tickets_history', function(Blueprint $table)
                {
                        $table->dropforeign('incident_handler_id');
                        $table->dropforeign('ticket_id');
                        $table->dropforeign('ticket_status_id');
                });
                */
        }


}
