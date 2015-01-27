<?php

   class OccurrenceTypeSeeder extends Seeder
   {

     public function run()
     {
       OccurenceType::create([

                'name' => 'Attacker' ,
                'description' =>'Wey que ataca',


                                        ]);
      OccurenceType::create([

               'name' => 'Target' ,
               'description' =>'Wey que lo atacan',


                                       ]);
    }

  }
