<?php

   class AttackTableSeeder extends Seeder
   {

     public function run()
     {

       $faker = Faker\Factory::create();

       /*
            foreach (range (1,23) as $index) {

                  Attack::create([
                  'name' => $faker->state,
                  'description' => $faker->paragraph($nbSentences = 2),

                                          ]);
        }*/
      Attack::create([
                  'name' => 'Malware',
                  'description' => ''
                  ]);

      Attack::create([
                  'name' => 'DoS/DDoS',
                  'description' => ''
                  ]);
      Attack::create([
                 'name' => 'Bruteforce',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Ataques Web',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Phishing',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Defacement',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Network Scanning/Recon',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'SQL Injection',
                 'description' => ''
                 ]);
      

       }


}
