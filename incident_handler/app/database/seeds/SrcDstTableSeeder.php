<?php

   class SrcDstTableSeeder extends Seeder
   {
     
     public function run()
     {
      
       $faker = Faker\Factory::create();

       
            foreach (range (1,12) as $index) {
                  
                  Src_Dst::create([
                    'src_id'=>$faker->numberBetween($min = 1, $max = 13),
                    'dst_id'=> $faker->numberBetween($min = 1, $max = 13),
                    'incidents_id' =>$faker->numberBetween($min = 1, $max = 13),
                                          ]);
        }
       }
}