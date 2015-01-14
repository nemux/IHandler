<?php

   class IncidentHistoryTableSeeder extends Seeder
   {
     
     public function run()
     {
      
       $faker = Faker\Factory::create();

       
            foreach (range (1,35) as $index) {
                  
                  IncidentHistory::create([
                  'datetime' => $faker->dateTime($max = 'now'),
                  'description' => $faker->paragraph($nbSentences = 2),
                  'incidents_status_id' =>$faker->numberBetween($min = 1, $max = 3),
                  'incident_handler_id' =>$faker->numberBetween($min = 1, $max = 22),
                  'incidents_id' =>$faker->numberBetween($min = 1, $max = 34),
                                          ]);
        }
       }
}