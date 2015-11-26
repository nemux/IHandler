<?php

use Illuminate\Database\Seeder;

class EvidenceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $evidence_types = [
            [
                'name' => 'Cibervigilancia',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'name' => 'Incidente',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'name' => 'Cerrado',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'name' => 'Falso Positivo',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
        ];
        foreach ($evidence_types as &$evidence_type) {
            \DB::table('evidence_type')->insert($evidence_type);
        }
    }
}
