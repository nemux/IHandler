<?php

use Illuminate\Database\Seeder;

class AttackFlowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attackFlows = [
            [
                'name' => 'Local',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'name' => 'Intrusión',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'name' => 'Extrusión',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ]
        ];
        foreach ($attackFlows as $attackFlow) {
            DB::table('attack_flow')->insert($attackFlow);
        }
    }
}
