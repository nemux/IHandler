<?php

   class EventsTableSeeder extends Seeder
   {

     public function run()
     {

       $faker = Faker\Factory::create();


            foreach (range (1,22) as $index) {

                  Occurence::create([
                    'ip' => $faker->ipv4,
                    'occurrences_types_id' => $faker->numberBetween($min = 1, $max = 3),
                                          ]);
        }
       }
}
