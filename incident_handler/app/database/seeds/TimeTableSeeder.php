<?php

   class TimeTableSeeder extends Seeder
   {
     
     public function run()
     {
      
       $faker = Faker\Factory::create();

       
            foreach (range (1,22) as $index) {
                  
                  Time::create([
                  'datetime' =>$faker->dateTime($max = 'now'),
                  'zone' =>$faker->timezone,
                  'time_types_id' =>$faker->numberBetween($min = 1, $max = 4),
                  'incidents_id' => $faker->numberBetween($min = 1, $max = 14),
                                          ]);
        }
       }
}