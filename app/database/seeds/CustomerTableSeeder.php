<?php

   class CustomerTableSeeder extends Seeder
   {

     public function run()
     {
       Customer::create([
                  'company' => 'Gobierno de Puebla',
                  'phone' => '5555555555',
                  'name' => 'SFA - Puebla',
                  'mail'=> 'fca@puebla.org',
                  'otrs_userID' => 'fca_puebla',
                  'otrs_userlogin' => 'fca_puebla',
                  'otrs_usercustomerID' => 'fca_puebla',
                  'otrs_validID' => '1'
                                          ]);
     }


}
