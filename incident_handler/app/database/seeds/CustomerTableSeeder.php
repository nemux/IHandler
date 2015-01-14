<?php

   class CustomerTableSeeder extends Seeder
   {
     
     public function run()
     {
      
       $faker = Faker\Factory::create();

       
            foreach (range (1,7) as $index) {
                  
                  Customer::create([
                  'company' => $faker->city,
                  'phone' => $faker->phoneNumber,
                  'name' =>$faker->firstNameMale,
                  'mail'=>$faker->companyEmail,
                                          ]);
        }
       }
}