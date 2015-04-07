<?php

   class ReferenceTableSeeder extends Seeder
   {
     
     public function run()
     {
      
       $faker = Faker\Factory::create();

       
            foreach (range (1,35) as $index) {
                  
                  References::create([
                  'link'=> $faker->url,
                  'title' => $faker->realText($maxNbChars = 50, $indexSize = 2),
                  'datetime' => $faker->dateTime($max = 'now'),
                  'cve' => $faker->numberBetween($min = 1000, $max = 9000),
                  'cvss' => $faker->numberBetween($min = 1000, $max = 9000),
                  'bid' => $faker->numberBetween($min = 1000, $max = 9000),
                  'sid' => $faker->numberBetween($min = 1000, $max = 9000),
                  'incidents_id'=> $faker->numberBetween($min = 1, $max = 32),
  
                                          ]);
        }
       }
}