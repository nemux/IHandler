<?php

   class ApplicationTableSeeder extends Seeder
   {
     
     public function run()
     {
      
       $faker = Faker\Factory::create();

       
            foreach (range (1,27) as $index) {
                  
                  Application::create([
                  'name' => $faker->state,
                  'description' => $faker->paragraph($nbSentences = 2),
                  'incidents_id' =>$faker->numberBetween($min = 1, $max = 24),
                                          ]);
        }
       }
}