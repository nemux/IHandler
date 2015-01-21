<?php

   class AttackerHistorySeeder extends Seeder
   {

     public function run()
     {

       $faker = Faker\Factory::create();


            foreach (range (1,18) as $index) {

                  OccurenceHistory::create([
                    'port' => $faker->randomDigitNotNull,
                    'protocol' =>$faker->word,
                    'operative_system' =>$faker->word,
                    'function' =>$faker->word,
                    'location' =>$faker->country,
                    'datetime' =>$faker->dateTime($max = 'now'),
                    'occurences_id' =>$faker->numberBetween($min = 3, $max = 8),
                    'incident_handler_id' =>$faker->numberBetween($min = 1, $max = 19),
                                          ]);
        }
       }
}
