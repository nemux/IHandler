<?php

   class IncidentHandlerSeeder extends Seeder
   {

     public function run()
     {

       $faker = Faker\Factory::create();


                  IncidentHandler::create([
                  'name' => 'Administrator',
                  'mail'  => 'admin@admin.com',
                  'phone' => '',
                  ]);
                  IncidentHandler::create([
                  'name' => 'René Alejandro',
                  'lastname' => 'Guevara Canales',
                  'mail'  => 'rguevara@globalcybersec.com',
                  'phone' => '',
                  ]);
                  IncidentHandler::create([
                  'name' => 'Eduardo',
                  'lastname' => 'Candia Guerrero',
                  'mail'  => 'ecandia@globalcybersec.com',
                  'phone' => '',
                  ]);
                  IncidentHandler::create([
                  'name' => 'Sergio Fabián',
                  'lastname' => 'García Ruíz',
                  'mail'  => 'sgarcia@globalcybersec.com',
                  'phone' => '',
                  ]);
                  IncidentHandler::create([
                  'name' => 'David',
                  'lastname' => 'Tejada Rentería',
                  'mail'  => 'dtejada@globalcybersec.com',
                  'phone' => '',
                  ]);
                  IncidentHandler::create([
                  'name' => 'Fernando',
                  'lastname' => 'Vázquez',
                  'mail'  => 'fvazquez@globalcybersec.com',
                  'phone' => '',
                  ]);
                  IncidentHandler::create([
                  'name' => 'Hugo Ulises',
                  'lastname' => 'Vázquez Martínez',
                  'mail'  => 'hvazquez@globalcybersec.com',
                  'phone' => '',
                  ]);
                  IncidentHandler::create([
                  'name' => 'Jaime Alejandro',
                  'lastname' => 'Victoria Miguel',
                  'mail'  => 'avictoria@globalcybersec.com',
                  'phone' => '',
                  ]);
                  IncidentHandler::create([
                  'name' => 'Isaac',
                  'lastname' => 'González Vázquez',
                  'mail'  => 'igonzalez@globalcybersec.com',
                  'phone' => '',
                  ]);
                  IncidentHandler::create([
                  'name' => 'Alonso',
                  'lastname' => 'Villalobos Montes',
                  'mail'  => 'avillalobos@globalcybersec.com',
                  'phone' => '',
                  ]);
                  IncidentHandler::create([
                  'name' => 'Josue',
                  'lastname' => 'Araujo Mayorga',
                  'mail'  => 'jaraujo@globalcybersec.com',
                  'phone' => '',
                  ]);



/*
                  IncidentHandler::create([
                  'name' => 'Usuario 1',
                  'lastname' => 'Usuario normalito',
                  'mail'  => 'usuario@mortal.com',
                  'phone' => '65156498561',
                  ]);

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
