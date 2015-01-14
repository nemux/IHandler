<?php

   class AttackerTableSeeder extends Seeder
   {
     
     public function run()
     {
      
       $faker = Faker\Factory::create();

       
            foreach (range (1,15) as $index) {
                  
                  Attacker::create([
                    'ip' => $faker->randomNumber($nbDigits = NULL),
                    'location' =>$faker->state,
                    'incidents_id' =>$faker->numberBetween($min = 1, $max = 13),
                    'attacker_types_id' => $faker->numberBetween($min = 1, $max = 6),
                                          ]);
        }
       }
}