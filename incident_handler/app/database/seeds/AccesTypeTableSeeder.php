<?php

   class AccesTypeTableSeeder extends Seeder
   {

     public function run()
     {

       /*$faker = Faker\Factory::create();


            foreach (range (1,3) as $index) {

                  AccessType::create([
                  'name' => $faker->word,
                  'description' => $faker->text($maxNbChars = 50),
                 ]);
        }
        */
       AccessType::create([
         'name' => 'admin',
         'description' => 'Admin User',
       ]);

       AccessType::create([
         'name' => 'user_1',
         'description' => 'Incident Handler Level 1',
       ]);

       AccessType::create([
         'name' => 'user_2',
         'description' => 'Incident Handler Level 1',
       ]);

       }
}

