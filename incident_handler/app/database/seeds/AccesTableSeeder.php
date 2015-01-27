<?php

   class AccesTableSeeder extends Seeder
   {

     public function run()
     {

       $faker = Faker\Factory::create();

         Access::create([

                  'username' => 'admin' ,
                  'password' => Hash::make('leonel'),
                  'incident_handler_id' => '1',
                  'access_types_id' => '1',
                  'active'=>'1',

                                          ]);
        Access::create([

                  'username' => 'user1' ,
                  'password' => Hash::make('leonel'),
                  'incident_handler_id' => '2',
                  'access_types_id' => '2',
                  'active'=>'1',

                                          ]);
       /*

            foreach (range (1,35) as $index) {

                  Access::create([

                  'username' => $faker->userName,
                  'password' => Hash::make('leonel'),
                  //'password' => $faker->creditCardNumber,
                  'incident_handler_id' => $faker->numberBetween($min = 4, $max = 35),
                  'access_types_id' =>$faker->numberBetween($min = 2, $max = 3),
                  'active'=>$faker->boolean($chanceOfGettingTrue = 0)

                                          ]);
        }*/
       }
}
