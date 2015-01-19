<?php

   class EventsTypeTableSeeder extends Seeder
   {
     
     public function run()
     {
      
       $faker = Faker\Factory::create();

       
            foreach (range (1,3) as $index) {

                  OccurenceType::create([

                    'name'=> $faker->state,
                    'description' => $faker->state,
                    ]);
 
       }
    }
}