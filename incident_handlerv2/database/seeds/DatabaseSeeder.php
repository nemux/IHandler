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

        $this->call(AttackFlowSeeder::class);
        $this->call(AttackCategorySeeder::class);
        $this->call(AttackSignatureSeeder::class);
        $this->call(AttackTypeSeeder::class);
        $this->call(MachineTypeSeeder::class);

        Model::reguard();
    }
}
