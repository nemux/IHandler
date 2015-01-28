<?php

   class EvidenceTypeSeeder extends Seeder
   {

     public function run()
     {

       $faker = Faker\Factory::create();


                  EvidenceType::create([
                  'name' => 'Tipo_1',
                  'description' => 'Es cuando se adjunta evidencia propia del incidente',

                  ]);


                  EvidenceType::create([
                  'name' => 'Tipo_2',
                  'description' => 'Evidencia de que el cliente notificó la recepción del correo',

                  ]);

          /*
            foreach (range (1,35) as $index) {


                  IncidentHandler::create([
                  'name' => $faker->firstName,
                  'lastname' => $faker->lastName,
                  'mail'  => $faker->email,
                  'phone' => $faker->phoneNumber,
                                          ]);
        }*/
       }
}
