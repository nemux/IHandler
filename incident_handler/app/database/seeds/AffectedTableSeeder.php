<?php

   class AffectedTableSeeder extends Seeder
   {
     
     public function run()
     {
      
       $faker = Faker\Factory::create();

       
            foreach (range (1,35) as $index) {
                  
                  Affected::create([
                  'source' =>$faker->country,
                  'datetime'=>$faker->dateTime($max = 'now'),
                  'affected_types_id' =>$faker->numberBetween($min = 1, $max = 4),
                  'incidents_id' =>$faker->numberBetween($min = 1, $max = 12),
  
                                          ]);
        }
       }
}
