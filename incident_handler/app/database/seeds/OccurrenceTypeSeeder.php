<?php

   class OccurrenceTypeSeeder extends Seeder
   {

     public function run()
     {
       OccurenceType::create([

                'name' => 'External' ,
                'description' =>'Wey que ataca',


                                        ]);
      OccurenceType::create([

               'name' => 'Internal' ,
               'description' =>'Wey que lo atacan',


                                       ]);
    }

  }
