<?php

use Illuminate\Database\Migrations\Migration;

class AddTsvSurveillance extends Migration
{
    private $table = 'surveillance_case';
    private $tsv_trigger = 'surveillance_case_ts_tsv';
    private $tsv_table_field = 'tsv';
    private $tsv_table_field_index = 'surveillance_tsv_gin';
    private $tsv_fields = "title || '' || description || '' || recommendation";
    private $tsv_trigger_fields = "'title', 'description', 'recommendation'";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = $this->table;
        $field = $this->tsv_table_field;
        $index = $this->tsv_table_field_index;
        $trigger = $this->tsv_trigger;
        $fields = $this->tsv_fields;
        $trigger_fields = $this->tsv_trigger_fields;

        DB::unprepared("ALTER TABLE $table ADD COLUMN $field TSVECTOR");
        DB::unprepared("UPDATE $table SET $field = to_tsvector('pg_catalog.spanish',$fields)");
        DB::unprepared("CREATE INDEX $index ON $table USING GIN($field);");
        DB::unprepared("CREATE TRIGGER $trigger BEFORE INSERT OR UPDATE ON $table FOR EACH ROW EXECUTE PROCEDURE tsvector_update_trigger('$field', 'pg_catalog.spanish',$trigger_fields);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = $this->table;
        $tsv_table_field = $this->tsv_table_field;
        $tsv_table_field_index = $this->tsv_table_field_index;
        $trigger = $this->tsv_trigger;

        DB::unprepared("DROP TRIGGER $trigger ON $table;");
        DB::unprepared("DROP INDEX $tsv_table_field_index RESTRICT");
        DB::unprepared("ALTER TABLE $table DROP $tsv_table_field");
    }
}
