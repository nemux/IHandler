<?php

   class AttackerTypeTableSeeder extends Seeder
   {
     
     public function run()
     {
      
       $faker = Faker\Factory::create();

       
            foreach (range (1,7) as $index) {
                  
                  AttackerType::create([
                  'name' => $faker->state,
                  'description' => $faker->paragraph($nbSentences = 2),
                                          ]);
        }
       }
}