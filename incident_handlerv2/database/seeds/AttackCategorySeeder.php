<?php

use Illuminate\Database\Seeder;

class AttackCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attackCategories = [
            [
                'name' => "CAT 0 - Pruebas de defensa en la red/Ejercicios Internos Ventanas de Mantenimiento",
                'description' => "Esta categoría es usada en ejercicios institucionales, estatales, federales, nacionales e internacionales y aprobados para actividades de  pruebas de defensa o respuesta en redes internas y externas.",
                'time_range' => "No aplicable; esta categoría es para uso interno de cada organismo o Institución durante los ejercicios de pruebas de seguridad.",
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            ['time_range' => "Dentro de una (1) hora del descubrimiento/detección.", 'name' => "CAT 1 - Acceso No Autorizado", 'description' => "En esta categoría un individuo obtiene acceso lógico o físico sin permiso a una red, sistema, aplicación, información, u otro recurso.", 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['time_range' => "Dentro de las dos (2) horas del descubrimiento/detección si el ataque exitoso todavía está en curso y la agencia no puede mitigar con éxito la actividad.", 'name' => "CAT 2 - Denegación de Servicio (DoS)", 'description' => "Un ataque que impida o entorpezca el normal funcionamiento en las redes, sistemas o aplicaciones agotando los recursos con éxito. Esta actividad incluye ser la víctima o participar en un ataque DoS.", 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['time_range' => "Diario. Nota: En el plazo de una (1) hora del descubrimiento/detección si está extendido por la agencia.", 'name' => "CAT 3 - Código Malicioso", 'description' => "Instalación exitosa de software malicioso (por ejemplo, virus, gusano, troyano u otra entidad basada en código malicioso) que infecte un sistema operativo o una aplicación. Las instituciones no están obligadas a reportar la política que ha puesto en cuarentena con éxito en el software del antivirus.", 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['time_range' => 'Semanal.', 'name' => "CAT 4 - Uso Indebido", 'description' => "Esta categoría es cuando un usuario o persona ha violado las políticas de uso aceptable institucionales.", 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['time_range' => "Mensual. Nota: Sí el sistema está clasificado, informe en un plazo de un (1) hora del descubrimiento y/o detección.", 'name' => "CAT 5 - Escaneos/Pruebas/Intentos de Acceso", 'description' => "Esta categoría incluye cualquier actividad que pretenda acceder o identificar un equipo de la Institución, puertos abiertos, protocolos, servicios, o cualquier combinación para después ser explotada. Esta actividad no se traduce directamente en un compromiso o en una denegación de servicio.", 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['time_range' => "No Aplicable; esta categoría es usada por cada Institución, para clasificar un potencial incidente que está siendo investigado.", 'name' => "CAT 6 - Investigación", 'description' => "Incidentes sin confirmar que son actividades potencialmente anómalas o maliciosas a juicio de la entidad que reporta para justificar una nueva revisión.", 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['time_range' => "No Aplicable;", 'name' => "CAT 7 - Brecha 3", 'description' => "El incidente ha establecido un canal de comunicación con un objetivo interno y tiene acceso a información sensible.", 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['time_range' => "No Aplicable;", 'name' => "CAT 8 - Brecha 2", 'description' => "El incidente ha divulgado información no sensible o datos para facilitar el acceso a la información.", 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['time_range' => "No Aplicable;", 'name' => "CAT 9 - Brecha 1", 'description' => "El incidente ha divulgado información sensible en cantidades pequeñas o de gran tamaño de información.", 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['time_range' => "No Aplicable;", 'name' => "Crisis 3", 'description' => "Se ha publicado información a través de medios de comunicación o en línea.", 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['time_range' => "No Aplicable;", 'name' => "Crisis 2", 'description' => "Perdida de información que implica llevar a cabo un análisis con consecuencias legales.", 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['time_range' => "No Aplicable;", 'name' => "Crisis 1", 'description' => "Perdida de información, daño físico o perdida de vida.", 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')]
        ];
        foreach ($attackCategories as $attackCategory) {
            DB::table('attack_category')->insert($attackCategory);
        }
    }


}
