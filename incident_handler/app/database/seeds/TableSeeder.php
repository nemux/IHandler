<?php

   class TableSeeder extends Seeder
   {
     
     public function run()
     {
      
       $faker = Faker\Factory::create();

       
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

