<?php

   class ImageTableSeeder extends Seeder
   {
     
     public function run()
     {
      
       $faker = Faker\Factory::create();

       
            foreach (range (1,27) as $index) {
                  
                  Image::create([
                    'source'=>$faker->url,
                    'file'=>$faker->imageUrl($width = 640, $height = 480),
                    'name'=>$faker->colorName,
                    'incidents_id'=>$faker->numberBetween($min = 1, $max = 13),
                                          ]);
        }
       }
}