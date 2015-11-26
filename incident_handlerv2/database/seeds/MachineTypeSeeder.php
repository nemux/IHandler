<?php

use Illuminate\Database\Seeder;

class MachineTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $machineTypes = [
            [
                'name' => 'EXTERNA',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'name' => 'INTERNA',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ]
        ];
        foreach ($machineTypes as $attackFlow) {
            \DB::table('machine_type')->insert($attackFlow);
        }
    }
}
