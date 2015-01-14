<?php

   class AccesTypeTableSeeder extends Seeder
   {
     
     public function run()
     {
      
       $faker = Faker\Factory::create();

       
            foreach (range (1,3) as $index) {
                  
                  AccessType::create([
                  'name' => $faker->word,
                  'description' => $faker->text($maxNbChars = 50),
                 ]);
        }
       }
}

