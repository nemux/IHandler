<?php

use Illuminate\Database\Seeder;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ticket_status')->insert([
            'name' => 'Abierto',
            'description' => 'Ticket recién creado',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
        DB::table('ticket_status')->insert([
            'name' => 'Investigación',
            'description' => 'Ticket sujeto a investigación por parte de un Incident Handler',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
        DB::table('ticket_status')->insert([
            'name' => 'Resuelto',
            'description' => 'Ticket que ha sido investigado y resuelto',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
        DB::table('ticket_status')->insert([
            'name' => 'Cerrado',
            'description' => 'Ticket cerrado',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
        DB::table('ticket_status')->insert([
            'name' => 'Falso Positivo',
            'description' => 'Cuando la amenaza detectada no era una amenaza real',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
        DB::table('ticket_status')->insert([
            'name' => 'Cerrado automático',
            'description' => 'El ticket ',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
    }
}
