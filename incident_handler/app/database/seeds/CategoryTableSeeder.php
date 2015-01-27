<?php

   class CategoryTableSeeder extends Seeder
   {

     public function run()
     {

       $faker = Faker\Factory::create();



                  Category::create([
                  'name' => 'CAT 0 - Ejercicio/Pruebas de Defensa de la Red',
                  'description' => 'Esta categoría es usada durante los ejercicios y actividades que prueban  de defensas o respuestas de la red interna/externa, han sido previamente aprobadas por la entidad.',
                  'time_range' => 'No aplicable; esta categoría es para el uso interno de cada dependencia durante los ejercicios.',
                                          ]);
                  Category::create([
                  'name' => 'CAT 1 - Acceso No Autorizado',
                  'description' => 'En esta categoría un individuo gana acceso físico o lógico sin el permiso del departamento de redes, sistemas, aplicación, datos, u otro recurso.',
                  'time_range' => 'Dentro de una (1) hora del descubrimiento/detección.',
                                          ]);

                  Category::create([
                  'name' => 'CAT 2 - Denegación de Servicio (DoS)',
                  'description' => 'Un ataque que impide o entorpece el funcionamiento normal de las redes, sistemas o aplicaciones. Esta actividad incluye ser la víctima o participar en el DoS.',
                  'time_range' => 'Dentro de las dos (2) horas del descubrimiento/detección si el ataque exitoso todavía está en curso y la agencia no puede mitigar con éxito la actividad.',
                                          ]);

                  Category::create([
                  'name' => 'CAT 3 - Código Malicioso',
                  'description' => 'Instalación exitosa de software malicioso (ej. Virus, caballos de Troya, o malware en general) que afecte un sistema operativo o aplicación. Las agencias no están obligadas a reportar el comportamiento malicioso que ha sido puesto en cuarentena exitosamente por programas antivirus (AV).',
                  'time_range' => 'Diario. Nota: En el plazo de una (1) hora del descubrimiento/detección si está extendido por la agencia.',
                                          ]);

                  Category::create([
                  'name' => 'CAT 4 - Uso Inapropiado',
                  'description' => 'Una persona viola las políticas del uso apropiado de los activos de red y cómputo.',
                  'time_range' => 'Semanal.',
                                          ]);

                  Category::create([
                  'name' => 'CAT 5 - Escaneos/Sondeos/Intento de Acceso',
                  'description' => 'Esta categoría incluye cualquier actividad que pretenda acceder o identificar un equipo de la agencia, puertos abiertos, protocolos, servicios,  o cualquier combinación para después explotarlos. Esta actividad no se traduce directamente en un compromiso o la denegación de servicio.',
                  'time_range' => 'Mensual. Nota: Si el sistema es clasificado, reportar en el plazo de una (1) hora del descubrimiento.',
                                          ]);

                  Category::create([
                  'name' => 'CAT 6 - Investigación',
                  'description' => 'Incidentes sin confirmar que son actividades potencialmente anómalas o maliciosas a juicio de la entidad que reporta para justificar una nueva revisión.',
                  'time_range' => 'No aplicable; esta categoría es para el uso de cada organismo para categorizar un incidente potencial que está siendo investigado actualmente.',
                                          ]);


       }
}
