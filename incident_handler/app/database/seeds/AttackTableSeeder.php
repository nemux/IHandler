<?php

   class AttackTableSeeder extends Seeder
   {
     
     public function run()
     {
      
       $faker = Faker\Factory::create();

       
            foreach (range (1,23) as $index) {
                  
                  Attack::create([
                  'name' => $faker->state,
                  'description' => $faker->paragraph($nbSentences = 2),

                                          ]);
        }
       }
}