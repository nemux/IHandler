<?php

   class CategoryTableSeeder extends Seeder
   {
     
     public function run()
     {
      
       $faker = Faker\Factory::create();

       
            foreach (range (1,23) as $index) {
                  
                  Category::create([
                  'name' => $faker->state,
                  'description' => $faker->paragraph($nbSentences = 2),
                  'time_range' => $faker->dateTimeThisDecade($max = 'now'),
                                          ]);
        }
       }
}