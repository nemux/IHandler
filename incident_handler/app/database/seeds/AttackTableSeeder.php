<?php

   class AttackTableSeeder extends Seeder
   {

     public function run()
     {

       //$faker = Faker\Factory::create();

       /*
            foreach (range (1,23) as $index) {

                  Attack::create([
                  'name' => $faker->state,
                  'description' => $faker->paragraph($nbSentences = 2),

                                          ]);
        }*/
       /*
      Attack::create([
                  'name' => 'Otros',
                  'description' => ''
                  ]);

      Attack::create([
                  'name' => 'Spam',
                  'description' => ''
                  ]);
      Attack::create([
                 'name' => 'Defacement',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Acoso',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Virus',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Gusano',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Troyano',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Spyware',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Escaneo de vulnerabilidades',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Sniffing',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Ingeniería Social',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Inyección SQL',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Pharming',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Inyección Remota de Archivos',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Ataques de fuerza bruta',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Explotación de vulnerabilidades',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Cross-Site Scripting',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Inyección otros tipos',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'DoS / DDoS',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Fallo (hw/sw)',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Error humano',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Copyright',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Suplantación',
                 'description' => ''
                 ]);
      Attack::create([
                 'name' => 'Phishing',
                 'description' => ''
                 ]);
      */
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
