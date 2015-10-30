<?php

use Illuminate\Database\Seeder;

class LinkTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page_types = [
            [
                'name' => 'Facebook',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'name' => 'Twitter',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'name' => 'G+',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'name' => 'Página Corporativa',
                'description' => 'Página perteneciente al cliente que está siendo constantemente monitoreada',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'name' => 'Página falsa',
                'description' => 'Página que suplanta otra web del cliente',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ]
        ];

        foreach ($page_types as $page_type) {
            DB::table('link_type')->insert($page_type);
        }
    }
}
