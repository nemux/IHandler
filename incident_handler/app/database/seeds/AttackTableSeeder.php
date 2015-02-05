<?php

   class AttackTableSeeder extends Seeder
   {

     public function run()
     {

     Attack::create([
         'name' => 'Attack',
         'description' => '',
       ]);

       Attack::create([
         'name' => 'Malware',
         'description' => '',
         'attack_parent_id' => 1,
       ]);

       Attack::create([
         'name' => 'DoS/DDoS',
         'description' => '',
         'attack_parent_id' => 1,
       ]);

       Attack::create([
         'name' => 'Bruteforce',
         'description' => '',
         'attack_parent_id' => 1,
       ]);

       Attack::create([
         'name' => 'Ataques Web',
         'description' => '',
         'attack_parent_id' => 1,
       ]);

       Attack::create([
         'name' => 'Phishing',
         'description' => '',
         'attack_parent_id' => 1,
       ]);

       Attack::create([
         'name' => 'Defacement',
         'description' => '',
         'attack_parent_id' => 1,
       ]);

       Attack::create([
         'name' => 'Network Scanning/Recon',
         'description' => '',
         'attack_parent_id' => 1,
       ]);

       Attack::create([
         'name' => 'SQL Injection',
         'description' => '',
         'attack_parent_id' => 1,
       ]);

       Attack::create([
         'name' => 'Worm',
         'description' => '',
         'attack_parent_id' => 2,
       ]);

       Attack::create([
         'name' => 'Spam',
         'description' => '',
         'attack_parent_id' => 2,
       ]);

       Attack::create([
         'name' => 'Bot',
         'description' => '',
         'attack_parent_id' => 2,
       ]);



       }


}
