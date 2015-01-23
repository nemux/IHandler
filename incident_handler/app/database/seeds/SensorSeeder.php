<?php

   class SensorSeeder extends Seeder
   {

     public function run()
     {
       $sensorInfo = [[
         'name' => 'Venus',
         'ip' =>'172.21.9.240',
         'customers_id'=>'1',
         'montage'=>'Firewall Out-Int'
       ],
       [
         'name' => 'Mercurio',
         'ip' =>'172.21.9.242',
         'customers_id'=>'1',
         'montage'=>'DMZ'
       ],
       [
         'name' => 'Marte',
         'ip' =>'172.21.9.241',
         'customers_id'=>'1',
         'montage'=>'LAN'
       ],
       [
         'name' => 'Jupiter',
         'ip' =>'172.21.9.243',
         'customers_id'=>'1',
         'montage'=>'SWITCH CORE'
       ]];

       foreach($sensorInfo as $s)
         Sensor::create($s);


      }
    }
