<?php

use Illuminate\Database\Seeder;

class AttackTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attackTypes = [
            ['name' => 'Attack', 'attack_type_parent_id' => NULL, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['name' => 'Malware', 'attack_type_parent_id' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['name' => 'DoS / DDoS', 'attack_type_parent_id' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['name' => 'Bruteforce', 'attack_type_parent_id' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['name' => 'Ataques Web', 'attack_type_parent_id' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['name' => 'Phishing', 'attack_type_parent_id' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['name' => 'Defacement', 'attack_type_parent_id' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['name' => 'Network Scanning / Recon', 'attack_type_parent_id' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['name' => 'SQL Injection', 'attack_type_parent_id' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['name' => 'Worm', 'attack_type_parent_id' => 2, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['name' => 'Spam', 'attack_type_parent_id' => 2, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['name' => 'Bot', 'attack_type_parent_id' => 2, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['name' => 'Violación de políticas de seguridad', 'description' => 'uso indebido', 'attack_type_parent_id' => 6, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['name' => 'Social Engineering', 'attack_type_parent_id' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')]
        ];
        foreach ($attackTypes as $attackType) {
            DB::table('attack_type')->insert($attackType);
        }
    }
}
