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

                 'username' => 'rguevara' ,
                 'password' => Hash::make('temp0ral'),
                 'incident_handler_id' => '2',
                 'access_types_id' => '1',
                 'active'=>'1',

                                         ]);
       Access::create([

                'username' => 'ecandia' ,
                'password' => Hash::make('temp0ral'),
                'incident_handler_id' => '3',
                'access_types_id' => '1',
                'active'=>'1',

                                        ]);
      Access::create([

               'username' => 'sgarcia' ,
               'password' => Hash::make('temp0ral'),
               'incident_handler_id' => '4',
               'access_types_id' => '1',
               'active'=>'1',

                                       ]);
     Access::create([

              'username' => 'dtejada' ,
              'password' => Hash::make('temp0ral'),
              'incident_handler_id' => '5',
              'access_types_id' => '1',
              'active'=>'1',

                                      ]);
    Access::create([

             'username' => 'fvazquez' ,
             'password' => Hash::make('temp0ral'),
             'incident_handler_id' => '6',
             'access_types_id' => '1',
             'active'=>'1',

                                     ]);
   Access::create([

            'username' => 'hvazquez' ,
            'password' => Hash::make('temp0ral'),
            'incident_handler_id' => '7',
            'access_types_id' => '1',
            'active'=>'1',

                                    ]);
  Access::create([

           'username' => 'avictoria' ,
           'password' => Hash::make('temp0ral'),
           'incident_handler_id' => '8',
           'access_types_id' => '1',
           'active'=>'1',

                                   ]);
 Access::create([

          'username' => 'igonzalez' ,
          'password' => Hash::make('temp0ral'),
          'incident_handler_id' => '9',
          'access_types_id' => '1',
          'active'=>'1',

                                  ]);
Access::create([

         'username' => 'avillalobos' ,
         'password' => Hash::make('temp0ral'),
         'incident_handler_id' => '10',
         'access_types_id' => '1',
         'active'=>'1',

                                 ]);
Access::create([

         'username' => 'jaraujo' ,
         'password' => Hash::make('temp0ral'),
         'incident_handler_id' => '11',
         'access_types_id' => '1',
         'active'=>'1',

                                 ]);


/*
        Access::create([

                  'username' => 'user1' ,
                  'password' => Hash::make('temp0ral'),
                  'incident_handler_id' => '2',
                  'access_types_id' => '2',
                  'active'=>'1',

                                          ]);


            foreach (range (1,35) as $index) {

                  Access::create([

                  'username' => $faker->userName,
                  'password' => Hash::make('temp0ral'),
                  //'password' => $faker->creditCardNumber,
                  'incident_handler_id' => $faker->numberBetween($min = 4, $max = 35),
                  'access_types_id' =>$faker->numberBetween($min = 2, $max = 3),
                  'active'=>$faker->boolean($chanceOfGettingTrue = 0)

                                          ]);
        }*/
       }
}
