<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Crear una persona
        $person_id = DB::table('person')->insert([
            'name' => 'Juan',
            'lname' => 'Pérez',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
            'sex' => 'M'
        ]);

        //Crear su usuario
        DB::table('user')->insert([
            'person_id' => $person_id,
            'user_type_id' => '1',
            'username' => 'admin',
            'password' => bcrypt('temp0ral'),
            'active' => true,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')

        ]);
    }
}
