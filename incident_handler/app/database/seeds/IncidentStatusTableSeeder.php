<?php

   class IncidentStatusTableSeeder extends Seeder
   {
     
     public function run()
     {
      
       $faker = Faker\Factory::create();

       
            foreach (range (1,35) as $index) {
                  
                  IncidentStatus::create([
                  'name' => $faker->word,
                  'description' => $faker->paragraph($nbSentences = 2),

                                          ]);
        }
       }
}