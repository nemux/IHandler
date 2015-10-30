<?php

use Illuminate\Database\Seeder;

class CriticitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $criticities = [
            [
                'name' => 'Alta',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'name' => 'Media',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'name' => 'Baja',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
        ];
        foreach ($criticities as $criticity) {
            DB::table('criticity')->insert($criticity);
        }
    }
}
