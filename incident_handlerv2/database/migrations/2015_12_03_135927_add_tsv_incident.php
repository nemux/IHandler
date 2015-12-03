<?php

use Illuminate\Database\Migrations\Migration;

class AddTsvIncident extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("ALTER TABLE incident ADD COLUMN tsv TSVECTOR");
        DB::unprepared("UPDATE incident SET tsv = to_tsvector('pg_catalog.spanish',title || '' || description || '' || recommendation || '' || reference)");
        DB::unprepared("CREATE INDEX incident_tsv_gin ON incident USING GIN(tsv);");
        DB::unprepared("CREATE TRIGGER incident_ts_tsv BEFORE INSERT OR UPDATE ON incident FOR EACH ROW EXECUTE PROCEDURE tsvector_update_trigger('tsv', 'pg_catalog.spanish','title', 'description', 'recommendation', 'reference');");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TRIGGER incident_ts_tsv ON incident;");
        DB::unprepared("DROP INDEX incident_tsv_gin RESTRICT");
        DB::unprepared("ALTER TABLE incident DROP tsv");
    }
}
