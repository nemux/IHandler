<?php

   class MethodTableSeeder extends Seeder
   {
     
     public function run()
     {
      
       $faker = Faker\Factory::create();

       
            foreach (range (1,9) as $index) {
                  
                  Method::create([
                  'name' => $faker->state,
                  'description' => $faker->paragraph($nbSentences = 2),
                  'incidents_id' => $faker->numberBetween($min = 1, $max = 13),
                                          ]);
        }
       }
}