<?php

   class AccesTableSeeder extends Seeder
   {
     
     public function run()
     {
      
       $faker = Faker\Factory::create();

       
            foreach (range (1,35) as $index) {
                  
                  Access::create([
                  'username' => $faker->userName,
                  'password' => $faker->creditCardNumber,
                  'incident_handler_id' => $faker->numberBetween($min = 1, $max = 34),
                  'access_types_id' =>$faker->numberBetween($min = 1, $max = 3),
                  'active'=>$faker->boolean($chanceOfGettingTrue = 0)
  
                                          ]);
        }
       }
}
