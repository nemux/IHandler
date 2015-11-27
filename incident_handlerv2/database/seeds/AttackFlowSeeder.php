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
                'name' => 'LOCAL',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'name' => 'INTRUSIÓN',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'name' => 'EXTRUSIÓN',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ]
        ];
        foreach ($attackFlows as &$attackFlow) {
            \DB::table('attack_flow')->insert($attackFlow);
        }
    }
}
