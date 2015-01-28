<?php

   class TimeTypeTableSeeder extends Seeder
   {

     public function run()
       {
         TimeType::create([

                  'name' => 'Detección' ,
                  'description' =>'Hora en que se detectó',


                                          ]);
        TimeType::create([

                 'name' => 'Ocurrencia' ,
                 'description' =>'Hora en que ocurrió',


                                         ]);
      }
}
