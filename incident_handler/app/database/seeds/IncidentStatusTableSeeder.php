<?php

   class IncidentStatusTableSeeder extends Seeder
   {

     public function run()
     {

       $incidentStatus = [
         ['name' => 'Abierto','description' => 'Reconocido pero aún no asignado a un recurso de soporte para su solución.'],
         ['name' => 'Investigación','description' => 'En el proceso de ser investigado y resuelto.'],
         ['name' => 'Resuelto','description' => 'La solución ha sido implementada pero la validación de que volvió a la normalidad por parte del negocio o el usuario final tofavía no ha ocurrido.'],
         ['name' => 'Cerrado','description' => 'El usuario o el negocio ha acordado que el incidente ha sido resueldo y que el estado normal de las operaciones ha sido restaurado.'],
       ];

       foreach($incidentStatus as $i)
         IncidentStatus::create($i);
       }
}
