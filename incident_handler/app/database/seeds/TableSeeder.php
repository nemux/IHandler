<?php

   class TableSeeder extends Seeder
   {
     
     public function run()
     {
      
       $faker = Faker\Factory::create();
                  

                  IncidentHandler::create([
                  'name' => 'admin',
                  'lastname' => 'the',
                  'mail'  => 'admin@admin.com',
                  'phone' => '651564985618574',
                  ]);

      
            foreach (range (1,35) as $index) {

                
                  IncidentHandler::create([
                  'name' => $faker->firstName,
                  'lastname' => $faker->lastName,
                  'mail'  => $faker->email,
                  'phone' => $faker->phoneNumber,
                                          ]);
        }
       }
}

