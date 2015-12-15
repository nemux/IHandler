<?php

namespace App\Library;


use App\Models\Incident\Incident;

class CsvGenerator
{
    /**
     * @var string
     */
    private $class;

    /**
     * @var \PHPExcel
     */
    private $document;

    /**
     * @var \PHPExcel_Worksheet
     */
    private $sheet;

    /**
     * Almacena un contador para las filas de los incidentes que se van insertando
     *
     * @var int
     */
    private $index = 1;

    public function __construct($class)
    {
        $this->class = $class;
        $this->document = new \PHPExcel();
        $this->sheet = $this->document->setActiveSheetIndex(0);
        $this->addHeaders();
    }

    /**
     * Genera el documento de word a partir de $document
     *
     * @return string
     */
    public function streamDocument()
    {
        $temp_file = tempnam(sys_get_temp_dir(), 'PHPExcel');
        $objWriter = \PHPExcel_IOFactory::createWriter($this->document, 'Excel2007');
//        $objWriter->setDelimiter(',');
//        $objWriter->setEnclosure('"');
//        $objWriter->setSheetIndex(0);
        $objWriter->save($temp_file);

        $file = file_get_contents($temp_file);
        unlink($temp_file);
        return $file;
    }

    /**
     * Agrega una nueva fila al documento de excel
     *
     */
    private function addHeaders()
    {
        //ID
        $this->sheet->setCellValue('A' . ($this->index), 'ID');
        //Titulo
        $this->sheet->setCellValue('B' . ($this->index), 'TÍTULO');
        //Categoria(s) ([id|name|description]...[...])
        $this->sheet->setCellValue('C' . ($this->index), 'CATEGORÍAS');
        //Sensor(es)
        $this->sheet->setCellValue('D' . ($this->index), 'SENSORES');
        //Ticket
        $this->sheet->setCellValue('E' . ($this->index), 'TICKET');
        //Estatus
        $this->sheet->setCellValue('F' . ($this->index), 'ESTATUS');
        //Indicador(es) de compromiso
        $this->sheet->setCellValue('G' . ($this->index), 'INDICADORES DE COMPROMISO');
        //Flujo del ataque
        $this->sheet->setCellValue('H' . ($this->index), 'FLUJO DEL ATAQUE');
        //Fecha de detección
        $this->sheet->setCellValue('I' . ($this->index), 'FECHA Y HORA DE DETECCIÓN');
        //Criticidad
        $this->sheet->setCellValue('J' . ($this->index), 'SEVERIDAD');
        //IP(s) de Origen (IP1|IP2|IPn)
        $this->sheet->setCellValue('K' . ($this->index), 'IP\'S ORIGEN');
        //IP(s) de Destino (IP1|IP2|IPn)
        $this->sheet->setCellValue('L' . ($this->index), 'IP\'S DESTINO');
        //IPS en Blacklist ([IP|Location]
        $this->sheet->setCellValue('M' . ($this->index), 'IP\'S EN BLACKLIST');
        //Descripcion
        $this->sheet->setCellValue('N' . ($this->index), 'DESCRIPCIÓN');
        //Recomendación
        $this->sheet->setCellValue('O' . ($this->index), 'RECOMENDACIONES');
        //Referenfcias
        $this->sheet->setCellValue('P' . ($this->index), 'REFERENCIAS');
        //Anexos ([title|field|content]...[...])
        $this->sheet->setCellValue('Q' . ($this->index), 'ANEXOS');

        $this->index++;
    }

    /**
     * Agrega una nueva fila al documento de excel
     *
     * @param Incident $incident
     */
    public function addIncident(Incident $incident)
    {
        //ID
        $this->sheet->setCellValue('A' . ($this->index), $incident->id);
        //Titulo
        $this->sheet->setCellValue('B' . ($this->index), trim($incident->title));
        //Categoria(s) ([id+1|name|description]...[...])
        $this->sheet->setCellValue('C' . ($this->index), self::getCategories($incident));
        //Sensor(es)
        $this->sheet->setCellValue('D' . ($this->index), self::getSensors($incident));
        //Ticket
        $this->sheet->setCellValue('E' . ($this->index), $incident->ticket->internal_number);
        //Estatus
        $this->sheet->setCellValue('F' . ($this->index), $incident->ticket->status->name);
        //Indicador(es) de compromiso
        $this->sheet->setCellValue('G' . ($this->index), self::getSignatures($incident));
        //Flujo del ataque
        $this->sheet->setCellValue('H' . ($this->index), $incident->flow->name);
        //Fecha de detección
        $this->sheet->setCellValue('I' . ($this->index), $incident->detection_time . ', GMT-6');
        //Criticidad
        $this->sheet->setCellValue('J' . ($this->index), $incident->criticity->name);
        //IP(s) de Origen (IP1|IP2|IPn)
        $this->sheet->setCellValue('K' . ($this->index), self::getIps($incident, 'source'));
        //IP(s) de Destino (IP1|IP2|IPn)
        $this->sheet->setCellValue('L' . ($this->index), self::getIps($incident, 'target'));
        //IPS en Blacklist ([IP|Location]
        $this->sheet->setCellValue('M' . ($this->index), self::getIps($incident, 'blacklist'));
        //Descripcion
        $this->sheet->setCellValue('N' . ($this->index), StringHelper::htmlToString($incident->description));
        //Recomendación
        $this->sheet->setCellValue('O' . ($this->index), StringHelper::htmlToString($incident->recommendation));
        //Referenfcias
        $this->sheet->setCellValue('P' . ($this->index), StringHelper::htmlToString($incident->reference));
        //Anexos ([title|field|content]...[...])
        $this->sheet->setCellValue('Q' . ($this->index), self::getAnnexes($incident));

        $this->index++;
    }

    /**
     * Genera una cadena de texto con los indicadores de compromiso
     *
     * @param Incident $case
     * @return string
     */
    private static function getSignatures(Incident $case)
    {
        $signatures = '';
        foreach ($case->signatures as $signature) {
            $signatures .= "[{$signature->signature->name}]";
        }
        return $signatures;
    }

    /**
     * Genera una cadena de texto con las categorías del incidente
     *
     * @param $case
     * @return string
     */
    private static function getCategories($case)
    {
        $categories = '';

        foreach ($case->categories as $category) {
            $id = $category->category->id + 1;
            $categories .= "[{$id}|{$category->category->name}|{$category->category->description}]";
        }

        return $categories;
    }

    /**
     * Genera un string con los datos de los anexos de un incidente
     *
     * @param $incident
     * @return string
     */
    private static function getAnnexes($incident)
    {
        $annexes = '';

        foreach ($incident->annexes as $annex) {
            $content = StringHelper::htmlToString($annex->content);
            $annexes .= "[{$annex->title}|{$annex->field}|{$content}]";
        }

        return $annexes;
    }

    /**
     * Genera un string con las IPs de las máquinas origen, destino o si están en blacklist
     *
     * @param $incident
     * @param $type [source|target|blacklist]
     * @return string
     * @throws \Exception
     */
    private static function getIps($incident, $type)
    {
        $ips = '';

        foreach ($incident->events as $event) {
            $source_m = $event->source;
            $target_m = $event->target;

            if ($type == 'source') {
                if ($source_m->asset->ipv4 != '')
                    $ips .= "[{$source_m->asset->ipv4}]";
            } else if ($type == 'target') {
                if ($target_m->asset->ipv4 != '')
                    $ips .= "[{$target_m->asset->ipv4}]";
            } else if ($type == 'blacklist') {
                if ($source_m->blacklist) {
                    $location = $source_m->location ? $source_m->location->name : 'Undefined';
                    $ips .= "[{$source_m->asset->ipv4}|{$location}]";
                }
                if ($target_m->blacklist) {
                    $location = $target_m->location ? $target_m->location->name : 'Undefined';
                    $ips .= "[{$target_m->asset->ipv4}|{$location}]";
                }
            } else {
                throw new \Exception("El tipo '$type' no es válido, sólo [source|target|blacklist] son permitidos");
            }
        }

        return $ips;
    }

    /**
     * Genera un string con los nombres de los sensores de un Incidente
     *
     * @param $incident
     * @return string
     */
    private static function getSensors($incident)
    {
        $sensors = '';

        foreach ($incident->sensors as $sensor) {
            $sensors .= "[{$sensor->sensor->name}]";
        }

        return $sensors;
    }
}