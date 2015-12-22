<?php

namespace App\Library;


use App\Models\Catalog\Criticity;
use App\Models\Incident\Annex;
use App\Models\Incident\Incident;
use App\Models\Incident\IncidentEvent;
use App\Models\Incident\Machine;
use Illuminate\Database\Eloquent\Collection;
use PhpOffice\PhpWord\Element\Section;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Shared\Html;

class WordGenerator
{
    /**
     * @var PhpWord $document
     */
    protected $document;

    /**
     * @var Section $section
     */
    protected $section;
    /**
     * @var array $cases
     */
    protected $cases = [];
    /**
     * @var $class
     */
    protected $class;
    /**
     * @var $type
     */
    protected $type;

    /**
     * Genera un documento con los elementos en tipo tabla
     */
    const TYPE_TABLE = 1;
    /**
     * Genera un documento con los elementos en tipo lista
     */
    const TYPE_LIST = 2;

    /**
     * @param $class : Clase que se utilizará para los casos
     * @param $type : Tipo de documento que se generará
     */
    public function __construct($class, $type = self::TYPE_TABLE)
    {
        $this->class = $class;
        $this->type = $type;

        if ($class == Incident::class) {
            $this->bold_f = ['bold' => true];
            $this->normal_f = ['bold' => false];
            $this->center_p = ['align' => 'center'];

            $this->full_width = Converter::cmToTwip(18);
            $this->left_col_t = Converter::cmToTwip(5);
            $this->right_col_t = Converter::cmToTwip(13);

            $this->inner_cell_t = $this->right_col_t / 2;

            $this->table_s = ['borderColor' => '000000', 'borderSize' => 0.75, 'width' => 50 * 100, 'unit' => 'pct', 'cellMargin' => Converter::pointToTwip(6)];
            $this->row_s = ['borderColor' => '000000', 'borderSize' => 0.75];
            $this->gray_cell = ['bgColor' => 'CCCCCC', 'borderSize' => 0.75, 'valign' => 'center'];
            $this->normal_cell = ['bgColor' => 'FFFFFF', 'borderSize' => 0.75, 'valign' => 'center'];
        }

        $this->document = new PhpWord();
        $this->document->setDefaultFontName('Arial');
        $this->document->setDefaultFontSize(11);
        $this->document->setDefaultParagraphStyle(['align' => 'left', 'spaceBefore' => Converter::pointToTwip(0), 'spaceAfter' => Converter::pointToTwip(0), 'lineHeight' => 1.15]);

        $this->document->addTitleStyle(1, ['bold' => true, 'italic' => true, 'size' => 18], ['indent' => 1, 'align' => 'left', 'spaceBefore' => Converter::pointToTwip(6), 'spaceAfter' => Converter::pointToTwip(12), 'lineHeight' => 1.5]);
        $this->document->addTitleStyle(2, ['bold' => true, 'italic' => true, 'size' => 16], ['indent' => 2, 'align' => 'left', 'spaceBefore' => Converter::pointToTwip(6), 'spaceAfter' => Converter::pointToTwip(12), 'lineHeight' => 1.5]);
        $this->document->addTitleStyle(3, ['bold' => true, 'italic' => true, 'size' => 14], ['indent' => 3, 'align' => 'left', 'spaceBefore' => Converter::pointToTwip(6), 'spaceAfter' => Converter::pointToTwip(12), 'lineHeight' => 1.5]);
        $this->document->addTitleStyle(4, ['bold' => true, 'italic' => true, 'size' => 12], ['indent' => 4, 'align' => 'center', 'spaceBefore' => Converter::pointToTwip(6), 'spaceAfter' => Converter::pointToTwip(6), 'lineHeight' => 1.5]);

        self::addSection();
    }

    /**
     * Agrega una seccion al documento
     * @param string $title
     */
    private function addSection($title = '')
    {
        $this->section = $this->document->addSection();
        $sectionStyle = $this->section->getStyle();
        $sectionStyle->setMarginTop(Converter::cmToTwip(2.5));
        $sectionStyle->setMarginRight(Converter::cmToTwip(1.84));
        $sectionStyle->setMarginBottom(Converter::cmToTwip(2.5));
        $sectionStyle->setMarginLeft(Converter::cmToTwip(1.25));
        $sectionStyle->setPaperSize('Letter');

        if ($title != '') {
            $this->section->addTitle($title);
        }
    }

    /**
     * Agrega un título al documento para separar una sección
     *
     * @param $title
     * @param int $depth
     */
    public function addTitle($title, $depth = 1)
    {
        $this->section->addTitle($title, $depth);
    }

    /**
     * Agrega casos al arreglo $this->cases para después generar el documento
     *
     * @param $cases
     */
    public function addCases($cases)
    {
        if ($this->class == Incident::class) {
            if ($cases instanceof Collection) {
                foreach ($cases as $i) {
                    if ($this->type == self::TYPE_TABLE)
                        $this->addIncidentTable($i);
                    else if ($this->type == self::TYPE_LIST) {
                        $this->addIncidentListItem($i);
                    }
                }
            } else if ($cases instanceof Incident) {
                if ($this->type == self::TYPE_TABLE)
                    $this->addIncidentTable($cases);
                else if ($this->type == self::TYPE_LIST) {
                    $this->addIncidentListItem($cases);
                }
            }
        }
    }

    public function addIncidentListItem(Incident $i)
    {
        $this->section->addListItem(trim($i->title) . " " . ($i->ticket ? $i->ticket->internal_number : 'Por asignar...'));
    }

    /**
     * Genera el documento de word a partir de $document
     * @return string
     */
    public function streamDocument()
    {
        $temp_file = tempnam(sys_get_temp_dir(), 'PHPWord');
        $objWriter = IOFactory::createWriter($this->document, 'Word2007');
        $objWriter->save($temp_file);
        $file = file_get_contents($temp_file);
        unlink($temp_file);
        return $file;
    }

    /**
     * Almacena en disco duro el archivo
     * @return string
     */
    public function saveDocument($name)
    {
        $objWriter = IOFactory::createWriter($this->document, 'Word2007');
        $objWriter->save('results/' . $name . '.docx');
    }

    /**
     * Agrega el título $title del incidente en la tabla $table
     *
     * @param Table $table : Tabla en la que se agregará el título
     * @param $title : Título del Incidente
     */
    private function addTableTitle(Table &$table, $title)
    {
        //Title row
        $title_row = $table->addRow(null, $this->row_s);
        $title_cell = $title_row->addCell(null, $this->gray_cell);
        $title_cell->addText('Incidente: ' . $title, $this->bold_f, $this->center_p);
        $title_cell->getStyle()->setGridSpan(2);
    }

    /**
     * Agrega a la tabla $table una fila que contiene el nombre del campo $label y el contenido del mismo $content
     *
     * @param Table $table
     * @param $label
     * @param $content
     * @param $align
     */
    private function addRowInfo(Table &$table, $label, $content, $align)
    {
        $row = $table->addRow(null, $this->row_s);
        $title_cell = $row->addCell($this->left_col_t, $this->gray_cell);
        $title_cell->addText($label, $this->bold_f, $this->center_p);

        $content_cell = $row->addCell($this->right_col_t, $this->normal_cell);
        $content_cell->addText($content, $this->normal_f, $align);
    }

    /**
     * Agrega la criticidad a la tabla del incidente
     *
     * @param Table $table
     * @param Criticity $criticity
     */
    private function addCriticity(Table &$table, Criticity $criticity)
    {
        $row = $table->addRow(null, $this->row_s);
        $title_cell = $row->addCell($this->left_col_t, $this->gray_cell);
        $title_cell->addText("Severidad:", $this->bold_f, $this->center_p);

        $content_cell = $row->addCell($this->right_col_t, $this->normal_cell);
        $cell_style = $content_cell->getStyle();

        switch ($criticity->id) {
            case 1:
                $cell_style->setBgColor('CC3F44');
                break;
            case 2:
                $cell_style->setBgColor('FF7900');
                break;
            case 3:
                $cell_style->setBgColor('F7CC31');
                break;

        }
        $content_cell->addText($criticity->name, $this->normal_f, $this->center_p);
    }

    /**
     * Agrega a la tabla $table una fila que contiene el nombre del campo $label y el contenido del mismo $content
     *
     * @param Table $table
     * @param $label
     * @param $content
     */
    private function addRowInfoHtml(Table &$table, $label, $content)
    {
        $row = $table->addRow(null, $this->row_s);
        $title_cell = $row->addCell($this->left_col_t, $this->gray_cell);
        $title_cell->addText($label, $this->bold_f, $this->center_p);

        $content_cell = $row->addCell($this->right_col_t, $this->normal_cell);
        Html::addHtml($content_cell, StringHelper::parseHtml($content));
    }

    /**
     * Agrega las categorías a la tabla del incidente
     *
     * @param Table $table
     * @param Incident $i
     */
    private function addCategories(Table &$table, Incident $i)
    {
        //Categoría row
        $category_row = $table->addRow(null, $this->row_s);
        $category_cell = $category_row->addCell($this->left_col_t, $this->gray_cell);
        $category_cell->addText('Categoría(s):', $this->bold_f, $this->center_p);

        $category_cell_c = $category_row->addCell($this->right_col_t, $this->normal_cell);

        foreach ($i->categories as $c) {
            $category_cell_c->addListItem(($c->category->id - 1) . ': ' . $c->category->noCat() . '; ' . $c->category->description, 0, $this->normal_f, null);//, $this->justify_p);
        }
    }

    /**
     * Agrega los sensores a la tabla del incidente
     *
     * @param Table $table
     * @param Incident $i
     */
    private function addSensors(Table &$table, Incident $i)
    {
        //Sensor row
        $sensor_row = $table->addRow(null, $this->row_s);
        $sensor_cell = $sensor_row->addCell($this->left_col_t, $this->gray_cell);
        $sensor_cell->addText('Sensor(es):', $this->bold_f, $this->center_p);

        $sensor_cell_c = $sensor_row->addCell($this->right_col_t, $this->normal_cell);

        foreach ($i->sensors as $sensor) {
            $sensor_cell_c->addListItem($sensor->sensor->name, 0, $this->normal_f, null, $this->center_p);
        }
    }

    /**
     * Agrega la lista de firmas a la tabla del incidente
     *
     * @param Table $table
     * @param Incident $i
     */
    private function addSignatures(Table &$table, Incident $i)
    {
        //Signatures row
        $row = $table->addRow(null, $this->row_s);
        $title_cell = $row->addCell($this->left_col_t, $this->gray_cell);
        $title_cell->addText('Indicador(es) de Compromiso:', $this->bold_f, $this->center_p);

        $content_cell = $row->addCell($this->right_col_t, $this->normal_cell);

        foreach ($i->signatures as $c) {
            $content_cell->addListItem($c->signature->name, 0, $this->normal_f, null, $this->center_p);
        }
    }

    /**
     * Agrega los Eventos a la tabla del incidente
     *
     * @param Table $table
     * @param Collection $incident_events
     */
    private function addEvents(Table $table, Collection $incident_events)
    {
        //Events row
        $e_row = $table->addRow(null, $this->row_s);

        $e_title_cell = $e_row->addCell($this->left_col_t, $this->gray_cell);
        $e_title_cell->addText('Eventos:', $this->bold_f, $this->center_p);

        $e_content_cell = $e_row->addCell($this->right_col_t, $this->gray_cell);

        $events_table = $e_content_cell->addTable(['borderSize' => null, 'cellMargin' => 0, 'width' => 50 * 100, 'unit' => 'pct', 'cellMargin' => Converter::pointToTwip(3)]);
        $event_row = $events_table->addRow(null, ['borderSize' => null]);

        $source = $event_row->addCell(null, ['bgColor' => 'CCCCCC', 'borderSize' => null, 'valign' => 'center']);
        $source->addText("Origen", $this->bold_f, $this->center_p);

        $target = $event_row->addCell(null, ['bgColor' => 'CCCCCC', 'borderSize' => null, 'valign' => 'center']);
        $target->addText("Destino", $this->bold_f, $this->center_p);

        $blacklist_table = null;

        foreach ($incident_events as $i_event) {
            $source_ip = $i_event->source->hide ? '' : $i_event->source->asset->ipv4;
            $target_ip = $i_event->target->hide ? '' : $i_event->target->asset->ipv4;

            $event_row = $events_table->addRow(null, ['borderSize' => null, 'cellMargin' => 0]);

            $source = $event_row->addCell(null, ['bgColor' => 'FFFFFF', 'borderSize' => null, 'valign' => 'center']);
            $source->addText($source_ip, $this->normal_f, $this->center_p);

            $target = $event_row->addCell(null, ['bgColor' => 'FFFFFF', 'borderSize' => null, 'valign' => 'center']);
            $target->addText($target_ip, $this->normal_f, $this->center_p);

            //Add source machine to blacklist
            if ($i_event->source->blacklist) {
                $this->addToBlacklist($table, $blacklist_table, $i_event->source);
            }

            //Add target machine to blacklist
            if ($i_event->target->blacklist) {
                $this->addToBlacklist($table, $blacklist_table, $i_event->target);
            }
        }
    }

    /**
     * Si $blacklist_table es null, agrega la tabla, además de que agrega los componentes que pertenecen a la blacklist
     *
     * @param Table $i_table
     * @param $blacklist_table
     * @param Machine $machine
     */
    private function addToBlacklist(Table &$i_table, &$blacklist_table, Machine $machine)
    {
        if ($blacklist_table == null) {
            $bl_header_row = $i_table->addRow(null, $this->row_s);
            $bl_title_cell = $bl_header_row->addCell($this->left_col_t, $this->gray_cell);
            $bl_title_cell->addText('Blacklist:', $this->bold_f, $this->center_p);

            $b_content_cell = $bl_header_row->addCell($this->right_col_t, $this->gray_cell);

            $blacklist_table = $b_content_cell->addTable(['borderSize' => null, 'cellMargin' => 0, 'width' => 50 * 100, 'unit' => 'pct', 'cellMargin' => Converter::pointToTwip(3)]);
            $bl_head = $blacklist_table->addRow(null, ['borderSize' => null]);

            $source = $bl_head->addCell(null, ['bgColor' => 'CCCCCC', 'borderSize' => null, 'valign' => 'center']);
            $source->addText("Dirección IP", $this->bold_f, $this->center_p);

            $target = $bl_head->addCell(null, ['bgColor' => 'CCCCCC', 'borderSize' => null, 'valign' => 'center']);
            $target->addText("País de Origen", $this->bold_f, $this->center_p);
        }

        $bl_row = $blacklist_table->addRow(null, ['borderSize' => null, 'cellMargin' => 0]);

        $source = $bl_row->addCell(null, ['bgColor' => 'FFFFFF', 'borderSize' => null, 'valign' => 'center']);
        $source->addText($machine->asset->ipv4, $this->normal_f, $this->center_p);

        $target = $bl_row->addCell(null, ['bgColor' => 'FFFFFF', 'borderSize' => null, 'valign' => 'center']);

        $target->addText($machine->location ? $machine->location->name : 'S/D', $this->normal_f, $this->center_p);
    }

    /**
     * Agrega el incidente $i al documento
     *
     * @param Incident $i
     */
    public function addIncidentTable(Incident $i)
    {
        $table = $this->section->addTable($this->table_s);

        //Título
        $this->addTableTitle($table, $i->title);

        //Ticket row
        $this->addRowInfo($table, "Número de Ticket:", isset($i->ticket->internal_number) ? $i->ticket->internal_number : 'Por asignar...', $this->center_p);

        //Status row
        $this->addRowInfo($table, "Estatus:", $i->ticket ? $i->ticket->status->name : 'Abierto', $this->center_p);

        //Categorías
        $this->addCategories($table, $i);

        //Sensores
        $this->addSensors($table, $i);

        //Signatures row
        $this->addSignatures($table, $i);

        //Flow row
        $this->addRowInfo($table, 'Flujo del Ataque:', $i->flow->name, $this->center_p);

        //Flow row
        $this->addRowInfo($table, 'Fecha de Detección:', date('d/m/Y H:i', strtotime($i->detection_time)) . " GMT-6", $this->center_p);

        //Criticity row
        $this->addCriticity($table, $i->criticity);

        //Events with blacklist row
        $this->addEvents($table, $i->events);

        //Description row
        $this->addRowInfoHtml($table, "Descripción:", $i->description);

        //Recommendation row
        $this->addRowInfoHtml($table, "Recomendación(es):", $i->recommendation);

        //Reference row
        $this->addRowInfoHtml($table, "Referencia(s):", $i->reference);

        //Annexes n-rows
        if (sizeof($i->annexes) > 0) {
            $this->section->addTitle('Anexos', 4);
            $annex_table = $this->section->addTable($this->table_s);
            foreach ($i->annexes as $annex) {
                $this->addAnnex($annex_table, $annex);
            }
        }

        $this->section->addTextBreak(1, $this->normal_f, $this->center_p);
    }

    /**
     * Agrega el anexo $annex al documento
     *
     * @param Table $annex_table
     * @param Annex $annex
     */
    private function addAnnex(Table &$annex_table, Annex $annex)
    {

        $annex_row = $annex_table->addRow(null, $this->row_s);

        $title_cell = $annex_row->addCell($this->left_col_t, $this->gray_cell);
        $title_cell->addText($annex->title, $this->bold_f, $this->center_p);

        $content_cell = $annex_row->addCell($this->right_col_t, $this->normal_cell);
        $content_cell->addText($annex->field, $this->bold_f, $this->center_p);
        $html = $annex->content;
        Html::addHtml($content_cell, StringHelper::parseHtml($html));
    }
}