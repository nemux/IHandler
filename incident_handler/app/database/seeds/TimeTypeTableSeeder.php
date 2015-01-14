<?php

   class TimeTypeTableSeeder extends Seeder
   {
     
     public function run()
     {
      
       $faker = Faker\Factory::create();

       
            foreach (range (1,5) as $index) {
                  
                  TimeType::create([
                  'name' => $faker->word,
                  'description' => $faker->paragraph($nbSentences = 2),
                                          ]);
        }
       }
}