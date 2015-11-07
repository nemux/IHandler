<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserTypeSeeder::class);
        $this->call(UserTableSeeder::class);

        $this->call(LinkTypeSeeder::class);
        $this->call(EvidenceTypeSeeder::class);

        $this->call(CriticitySeeder::class);

        $this->call(TicketStatusSeeder::class);

        Model::reguard();
    }
}
