<?php

use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Catalog Seeding
         */
        DB::table('user_type')->insert([
            'name' => 'admin',
            'description' => 'Administrador del sistema',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
        DB::table('user_type')->insert([
            'name' => 'coord',
            'description' => 'Coordinador del SOC',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
        DB::table('user_type')->insert([
            'name' => 'colab',
            'description' => 'Creador de Incidentes',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
    }
}
