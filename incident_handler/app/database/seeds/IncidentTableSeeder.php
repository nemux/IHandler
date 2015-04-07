<?php

   class IncidentTableSeeder extends Seeder
   {

     public function run()
     {

       $faker = Faker\Factory::create();


            foreach (range (1,35) as $index) {

                  Incident::create([
                  'risk' => $faker->randomDigitNotNull,
                  'criticity' => $faker->randomDigitNotNull,
                  'impact' => $faker->randomDigitNotNull,
                  'description' =>$faker->randomDigitNotNull,
                  'file'=>$faker->randomDigitNotNull,
                  'conclution'=>$faker->text($maxNbChars = 200),
                  'recomendation'=>$faker->text($maxNbChars = 200),
                  'categories_id' =>$faker->numberBetween($min = 1, $max = 5),
                  'attacks_id' =>$faker->numberBetween($min = 1, $max = 5),
                  'customers_id' =>$faker->numberBetween($min = 1, $max = 1),
                  'incident_handler_id' =>$faker->numberBetween($min = 1, $max = 24),
                  'sensors_id' => $faker->numberBetween($min = 1, $max = 4),
                                          ]);
        }
       }
}
