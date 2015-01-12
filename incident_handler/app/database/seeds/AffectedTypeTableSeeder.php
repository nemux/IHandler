<?php

   class AffectedTypeTableSeeder extends Seeder
   {
     
     public function run()
     {
      
       $faker = Faker\Factory::create();

       
            foreach (range (1,4) as $index) {
                  
                  AffectedType::create([
                  'name' =>$faker->city,
                  'description'=>$faker->paragraph($nbSentences = 2),
                                          ]);
        }
       }
}
