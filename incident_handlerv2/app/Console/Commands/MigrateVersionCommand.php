<?php

namespace App\Console\Commands;

use App\Models\Asset\Asset;
use App\Models\Catalog\AttackCategory;
use App\Models\Catalog\AttackFlow;
use App\Models\Catalog\AttackSignature;
use App\Models\Catalog\AttackType;
use App\Models\Catalog\Criticity;
use App\Models\Catalog\Location;
use App\Models\Customer\Customer;
use App\Models\Customer\CustomerAsset;
use App\Models\Customer\CustomerContact;
use App\Models\Customer\CustomerEmployee;
use App\Models\Customer\CustomerEmployeePage;
use App\Models\Customer\CustomerPage;
use App\Models\Customer\CustomerSensor;
use App\Models\Evidence\Evidence;
use App\Models\Evidence\EvidenceType;
use App\Models\Incident\Annex;
use App\Models\Incident\History;
use App\Models\Incident\Incident;
use App\Models\Incident\IncidentAttackCategory;
use App\Models\Incident\IncidentAttackSignature;
use App\Models\Incident\IncidentCustomerSensor;
use App\Models\Incident\IncidentEvent;
use App\Models\Incident\IncidentEvidence;
use App\Models\Incident\Machine;
use App\Models\Incident\MachineType;
use App\Models\Incident\Note;
use App\Models\Link\Link;
use App\Models\Link\LinkType;
use App\Models\Person\Person;
use App\Models\Person\PersonContact;
use App\Models\Surveillance\SurveillanceCase;
use App\Models\Surveillance\SurveillanceCaseEvidence;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketStatus;
use App\Models\User\User;
use App\Models\User\UserType;
use Illuminate\Console\Command;

class MigrateVersionCommand extends Command
{

    protected $name = 'version';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version:migrate {--perform= : Define un método específico para ejecutar} {--table= : Especifica a qué tabla se le hará la operación} {--rollback : Realiza un rollback de la base de datos} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando realizará la migración de la base de datos de la version 1 a la versión 2.';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->option('perform')) {
            $this->info('Ejecutando ' . $this->option('perform'));
            if ($this->option('perform') == 'references') {
                $this->references();
            } else if ($this->option('perform') == 'update' && $this->option('table') == 'incident_signature') {
                $this->signatures();
            } else if ($this->option('perform') == 'tickets') {
                $olds = $this->query('SELECT * FROM incidents WHERE id BETWEEN 4961 AND 6675'); //TODO remove date on production
                $bar = $this->output->createProgressBar(count($olds));
                $newtickets = [];

                foreach ($olds as $index => &$o) {
                    $no_ticket = $this->tickets($o);

                    if ($no_ticket) {
                        array_push($newtickets, $no_ticket);
                    }

                    $bar->advance();
                }
                $bar->finish();
                $this->alterSequence($this->query('SELECT * FROM tickets'), 'ticket');
                $this->saveEmptyTickets($newtickets);
            }
        } else {
            if ($this->confirm('Este proceso eliminará la información actual de la base de datos; ningún proceso se podrá deshacer. ¿Deseas Continuar? [y|N]')) {
                $this->info('Ejecutando todas las instrucciones');
                if ($this->option('rollback') != null) {
                    $this->rollback();
                } else {
                    //TODO drops/truncate specific table
                }
                $this->migrate();
                $this->catalogs();
                $this->persons();
                $this->users();
                $this->customers();
                $this->surveillances();
                $this->incidents();
            }
        }
        $this->info("");
        $this->info("Terminado [" . date('d/m/Y H:i:s') . "]");
    }

    private function references()
    {

        $incidents = Incident::all();


        $bar = $this->output->createProgressBar(count($incidents));

        foreach ($incidents as $incident) {
            $r = $this->query('SELECT link FROM public.references WHERE incidents_id=' . $incident->id . ' LIMIT 1');
            if (sizeof($r) > 0)
                $incident->reference = $r[0]->link;
            else
                $incident->reference = 'SD';
            $incident->save();

            $bar->advance();
        }
        $bar->finish();

    }

    /**
     * Hace un rollback de toda la base de datos
     */
    private function rollback()
    {
        $this->info("Eliminando la base de datos");
        $code = \Artisan::call('migrate:rollback');
        $this->info("Eliminacion completada ($code)");
    }

    private function migrate()
    {
        $this->info("Creando la estructura de la base de datos");
        $code = \Artisan::call('migrate');
        $this->info("Creación completada ($code)");
    }

    /**
     * Migra los catálogos
     */
    private function catalogs()
    {

        //AccessTypes a UserType
        if (UserType::count() == 0) {
            $this->info("Migrando el catálogo de UserType");
            $accestypes = $this->query('SELECT * FROM access_types');

            foreach ($accestypes as &$atype) {
                $utype = new UserType();
                $this->modelTimestamps($utype, $atype);
                $utype->id = $atype->id;
                $utype->name = $atype->name;
                $utype->description = $atype->description;
                $utype->save();
            }
            $this->alterSequence($accestypes, 'user_type');
        }
        //Attacks a AttackType
        if (AttackType::count() == 0) {
            $this->info("Migrando el catálogo AttackType");
            $atypes = $this->query('SELECT * FROM attacks');
            foreach ($atypes as &$atype) {
                $attackType = new AttackType();
                $this->modelTimestamps($attackType, $atype);
                $attackType->id = $atype->id;
                $attackType->name = $atype->name;
                $attackType->description = $atype->description;
                $attackType->attack_type_parent_id = $atype->attack_parent_id;
                $attackType->save();
            }
            $this->alterSequence($atypes, 'attack_type');
        }
        //Categories a AttackCategory
        if (AttackCategory::count() == 0) {
            $this->info("Migrando el catálogo AttackCategory");
            $olds = $this->query('SELECT * FROM categories ');
            foreach ($olds as &$old) {
                $new = new AttackCategory();
                $this->modelTimestamps($new, $old);
                $new->id = $old->id;
                $new->name = $old->name;
                $new->description = $old->description;
                $new->time_range = $old->time_range;
                $new->save();
            }
            $this->alterSequence($olds, 'attack_category');
        }
        //Criticity a Criticity
        if (Criticity::count() == 0) {
            $this->info("Migrando el catálogo Criticity");
            $olds = $this->query('SELECT * FROM criticity ');
            foreach ($olds as &$old) {
                $new = new Criticity();
                $this->modelTimestamps($new, $old);
                $new->id = $old->id;
                $new->name = $old->name;
                $new->description = $old->description;
                $new->save();
            }
            $this->alterSequence($olds, 'criticity');
        }

        //Signatures a AttackSignature
        if (AttackSignature::count() == 0) {
            $this->info("Migrando el catálogo AttackSignature");
            $olds = $this->query('SELECT * FROM signatures ');
            foreach ($olds as &$old) {
                $new = new AttackSignature();
                $this->modelTimestamps($new, $old);
                $new->id = $old->id;
                $new->name = $old->signature;
                $new->description = $old->description;
                $new->recommendation = $old->recommendation;
                $new->risk = $old->risk;
                $new->reference = $old->reference;
                $new->save();
            }
            $this->alterSequence($olds, 'attack_signature');
        }
        $this->rules();

        if (TicketStatus::count() == 0) {
            $this->info("Migrando el catálogo TicketStatus");
            $olds = $this->query('SELECT * FROM incidents_status');
            foreach ($olds as &$old) {
                $new = new TicketStatus();
                $this->modelTimestamps($new, $old);
                $new->id = $old->id;
                $new->name = $old->name;
                $new->description = $old->description;
                $new->save();
            }
            $this->alterSequence($olds, 'ticket_status');
        }

        //Seed LinkTypeSeeder
        if (LinkType::count() == 0) {
            $this->info("Migrando el catálogo LinkType");
            $exit = \Artisan::call("db:seed", ['--class' => 'LinkTypeSeeder']);
            $this->info("Finalizado ($exit)");
        }

        //Seed EvidenceTypeSeeder
        if (EvidenceType::count() == 0) {
            $this->info("Migrando el catálogo EvidenceType");
            $exit = \Artisan::call("db:seed", ['--class' => 'EvidenceTypeSeeder']);
            $this->info("Finalizado ($exit)");
        }

        if (AttackFlow::count() == 0) {
            $this->info("Migrando el catálogo AttackFlow");
            $exit = \Artisan::call("db:seed", ['--class' => 'AttackFlowSeeder']);
            $this->info("Finalizado ($exit)");
        }


        if (MachineType::count() == 0) {
            $this->info("Migrando el catálogo MachineType");
            $exit = \Artisan::call("db:seed", ['--class' => 'MachineTypeSeeder']);
            $this->info("Finalizado ($exit)");
        }
        if (Location::count() == 0) {
            $this->info("Migrando el catálogo Location");
            $exit = \Artisan::call("db:seed", ['--class' => 'LocationSeeder']);
            $this->info("Finalizado ($exit)");
        }
    }

    /**
     * Migra las personas y sus datos de contacto
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function persons()
    {
        if (Person::count() == 0) {
            $this->info("Migrando los objetos Person");
            $persons = \DB::connection('old_pgsql')->select(\DB::raw('SELECT * FROM incident_handler '));

            foreach ($persons as &$p) {
                try {
                    $person = new Person();
                    $this->modelTimestamps($person, $p);
                    $contact = new PersonContact();
                    $this->modelTimestamps($contact, $p);

                    $person->id = $p->id;
                    $person->name = $p->name;
                    $person->lname = $p->lastname;
                    $person->sex = 'N';
                    $person->save();

                    $contact->person_id = $person->id;
                    $contact->email = $p->mail;
                    $contact->phone = $p->phone;
                    $contact->save();
                } catch (\Exception $e) {
                    $this->showError($e, 'persona', $p->id);
                    //return;
                }
            }
            $this->alterSequence($persons, 'person');
        }
    }

    /**
     * Migra la información de los usuarios del sistema
     */
    private function users()
    {
        if (User::count() == 0) {
            $olds = $this->query('SELECT * FROM access');
            foreach ($olds as &$o) {
                try {
                    $n = new User();
                    $this->modelTimestamps($n, $o);
                    $n->id = $o->id;
                    $n->person_id = $o->incident_handler_id;
                    $n->user_type_id = $o->access_types_id;
                    $n->username = $o->username;
                    $n->password = $o->password;
                    $n->active = !$o->active;
                    $n->remember_token = $o->remember_token;

                    $n->save(['user' => 'MIGRATION', 'model' => $n]);
                } catch (\Exception $e) {
                    $this->showError($e, 'usuario', $o->id);
                    //return;
                }
            }
            $this->alterSequence($olds, 'user');
        }
    }

    /**
     *Migra la información de los clientes
     */
    private function customers()
    {
        if (Customer::count() == 0) {

            $this->info("Migrando los objetos Customer");
            $olds = $this->query('SELECT * FROM customers');
            foreach ($olds as &$oC) {
                try {
                    $n = new Customer();
                    $this->modelTimestamps($n, $oC);
                    $n->id = $oC->id;
                    $n->name = $oC->name;
                    $n->business_name = $oC->company;
//                    $n->user_id = 1;
                    $n->otrs_customer_id = $oC->otrs_usercustomerID;
                    $n->otrs_user_id = $oC->otrs_userID;
                    $n->save();

                    //Sensors
                    $oSensors = $this->query("SELECT * FROM sensors WHERE customers_id=$oC->id");
                    foreach ($oSensors as &$oS) {
                        $nS = new CustomerSensor();
                        $this->modelTimestamps($nS, $oS);
                        $nS->id = $oS->id;
                        $nS->name = $oS->name;
                        $nS->ipv4 = trim($oS->ip);
                        $nS->mount_point = $oS->montage;
                        $nS->customer_id = $oC->id;
//                        $nS->user_id = 1;
                        $nS->save();
                    }

                    //Person
                    $person = new Person();
                    $this->modelTimestamps($person, $oC);
                    $person->name = $oC->name;
                    $person->lname = $oC->company;
                    $person->sex = 'U';
                    $person->save();

                    //Contact
                    $contact = new PersonContact();
                    $this->modelTimestamps($contact, $oC);
                    $contact->person_id = $person->id;
                    $contact->phone = $oC->phone;
                    $contact->email = $oC->mail;
                    $contact->save();

                    //CustomerContact
                    $customerContact = new CustomerContact();
                    $this->modelTimestamps($customerContact, $oC);
                    $customerContact->customer_id = $oC->id;
                    $customerContact->person_id = $person->id;
//                    $customerContact->user_id = 1;
                    $customerContact->save();

                    //CustomerAssets
                    $oAssets = $this->query("SELECT * FROM customer_assets WHERE customer_id=$oC->id");
                    foreach ($oAssets as &$oA) {
                        $asset = new Asset();
                        $this->modelTimestamps($asset, $oA);
                        $asset->domain_name = $oA->domain_name;
                        $asset->ipv4 = trim($oA->ip);
//                        $asset->user_id = 1;
                        $asset->save();

                        $nA = new CustomerAsset();
                        $this->modelTimestamps($nA, $oA);
                        $nA->id = $oA->id;
                        $nA->customer_id = $oC->id;
//                        $nA->user_id = 1;
                        $nA->asset_id = $asset->id;
                        $nA->comments = $oA->comments;
                        $nA->save();
                    }

                    //CustomerEmployees
                    $oEmployees = $this->query("SELECT * FROM customer_employees WHERE customer_id=$oC->id");
                    foreach ($oEmployees as &$oE) {
                        $person = new Person();
                        $this->modelTimestamps($person, $oE);
                        $person->name = $oE->name;
                        $person->lname = $oE->lastname;
                        $person->sex = 'U';
                        $person->save();

                        $contact = new PersonContact();
                        $this->modelTimestamps($contact, $oE);
                        $contact->email = $oE->personal_email;
                        $contact->person_id = $person->id;
                        $contact->save();

                        $nE = new CustomerEmployee();
                        $this->modelTimestamps($nE, $oE);
                        $nE->id = $oE->id;
                        $nE->person_id = $person->id;
                        $nE->customer_id = $oC->id;
                        $nE->email = $oE->corp_email;
                        $nE->comments = $oE->comments;
//                        $nE->user_id = 1;
                        $nE->save();

                        $link = new Link();
                        $this->modelTimestamps($link, $oE);
                        $link->link_type_id = 7; //Tipo Otro del catálogo
                        $link->link = $oE->socialmedia;
                        //$link->user_id = 1;
                        $link->save();

                        $page = new CustomerEmployeePage();
                        $this->modelTimestamps($page, $oE);
                        $page->customer_employee_id = $nE->id;
                        $page->link_id = $link->id;
                        //$link->user_id = 1;
                        $page->save();
                    }

                    //CustomerPages
                    $oPages = $this->query("SELECT * FROM customer_pages WHERE customer_id=$oC->id");
                    foreach ($oPages as &$oP) {
                        $link = new Link();
                        $this->modelTimestamps($link, $oP);
                        $link->link_type_id = $oP->page_type_id;
                        $link->link = $oP->url;
                        $link->comments = $oP->comments;
                        $link->save();

                        $nP = new CustomerPage();
                        $this->modelTimestamps($nP, $oP);
                        $nP->id = $oP->id;
                        $nP->customer_id = $oC->id;
                        $nP->link_id = $link->id;
                        $nP->save();
                    }
                } catch (\Exception $e) {
                    $this->showError($e, 'cliente', $oC->id);
                    //return;
                }
            }
            $this->alterSequence($this->query("SELECT * FROM sensors"), 'customer_sensor');
            $this->alterSequence($this->query("SELECT * FROM customer_assets"), 'customer_asset');
            $this->alterSequence($this->query("SELECT * FROM customer_employees"), 'customer_employee');
            $this->alterSequence($this->query("SELECT * FROM customer_pages"), 'customer_page');
            $this->alterSequence($olds, 'customer');
        }
    }

    private function showError(\Exception $e, $on, $id)
    {
        $this->error("----------------------------------------------------------------------------------------------------------------------");
        $this->error("Error al procesar el $on con ID $id ");
        $this->error("Message: " . $e->getMessage() . " || File: " . $e->getFile() . "(" . $e->getLine() . ")");

        \Log::error("Error al procesar el $on con ID $id ");
        \Log::error("Message: " . $e->getMessage() . " || File: " . $e->getFile() . "(" . $e->getLine() . ")");
    }

    /**
     * Migra la información de los casos de cibervigilancia
     */
    private function surveillances()
    {
        if (SurveillanceCase::count() == 0) {
            $this->info("Migrando los objetos SurveillanceCase");
            $olds = $this->query('SELECT * FROM customer_socialmedia');
            foreach ($olds as &$o) {
                try {
                    $n = new SurveillanceCase();
                    $this->modelTimestamps($n, $o);
                    $n->id = $o->id;
                    $n->customer_id = $o->customer_id;
                    $n->criticity_id = $o->criticity_id;
                    $n->title = $o->title;
                    $n->description = $o->description;
                    $n->recommendation = $o->recommendation;
                    $n->description .= '<br/><br/>Referencias<br/>' . $o->reference;
                    $n->save();

                    //Evidences
                    $oEvidences = $this->query("SELECT * FROM socialmedia_evidence where socialmedia_id=$o->id");
                    foreach ($oEvidences as &$oE) {
                        $evidence = new Evidence();
                        $this->modelTimestamps($evidence, $oE);
                        $evidence->mime_type = 'unknow';
                        $evidence->path = substr($oE->file, 0, strrpos($oE->file, '/')); //La subcadena de file, sin el nombre del archivo
                        $evidence->name = $oE->name;
                        $evidence->original_name = $oE->name;
                        $evidence->note = $oE->footnote;
                        $evidence->md5 = $oE->md5;
                        $evidence->sha1 = $oE->sha1;
                        $evidence->sha256 = $oE->sha256;
                        $evidence->save();

                        $survEvidence = new SurveillanceCaseEvidence();
                        $this->modelTimestamps($survEvidence, $oE);
                        $survEvidence->id = $oE->id;
                        $survEvidence->surveillance_case_id = $oE->socialmedia_id;
                        $survEvidence->evidence_id = $evidence->id;
                        $survEvidence->note = $oE->footnote;
                        $survEvidence->save();
                    }
                } catch (\Exception $e) {
                    $this->showError($e, 'surveillance', $o->id);
                    //return;
                }
            }
            $this->alterSequence($this->query("SELECT * FROM socialmedia_evidence"), 'surveillance_case_evidence');
            $this->alterSequence($olds, 'surveillance_case');
        }
    }

    /**
     * Migra los componentes de las firmas y reglas
     */
    private function signatures()
    {
        $incidents = $this->query('SELECT * FROM incidents');
        $bar = $this->output->createProgressBar(count($incidents));
        foreach ($incidents as $index => &$incident) {
            try {
                $this->signaturesForIncident($incident);
            } catch (\Exception $e) {
                $this->showError($e, 'incidente', $incident->id);
            }

            $bar->advance();
        }
        $bar->finish();
    }

    private function signaturesForIncident($o)
    {
        //IncidentAttackSignature
        $oldSignatures = $this->query('SELECT * FROM incidents_signatures WHERE incidents_id=' . $o->id);

        foreach ($oldSignatures as &$oS) {
            $nS = new IncidentAttackSignature();
            $this->modelTimestamps($nS, $oS);
            $nS->incident_id = $oS->incidents_id;
            $nS->attack_signature_id = $oS->signatures_id;
            $nS->user_id = $o->incident_handler_id;
            $nS->save();
        }

        //IncidentsRules (Para la versión anterior a la de las Signatures)
        $oldRules = $this->query('SELECT * FROM incidents_rules WHERE incidents_id=' . $o->id);
        foreach ($oldRules as &$oR) {
            $rule = $this->query('SELECT * FROM rules WHERE id=' . $oR->rules_id . ' LIMIT 1');
            $signature = AttackSignature::whereRaw('name=\'' . trim($rule[0]->message) . '\'')->first();

            $nS = new IncidentAttackSignature();
            $this->modelTimestamps($nS, $oR);
            $nS->incident_id = $oR->incidents_id;
            $nS->attack_signature_id = $signature->id;
            $nS->user_id = $o->incident_handler_id;
            $nS->save();
        }
    }

    private function incidents()
    {
        if (Incident::count() == 0) {
            $this->info("Migrando los objetos Incident");
            $olds = $this->query('SELECT * FROM incidents WHERE id BETWEEN 4961 AND 6675'); //TODO remove date on production

            $bar = $this->output->createProgressBar(count($olds));

            $newtickets = [];

            foreach ($olds as $index => &$o) {
                try {
                    $n = $index + 1;
//                    $this->info("----($n/$total) Migrando incidente con ID $o->id");

                    $incident = new Incident();
                    $this->modelTimestamps($incident, $o);
                    $incident->id = $o->id;
                    $incident->user_id = $o->incident_handler_id;
                    $incident->title = $o->title;
                    $incident->description = $o->description;
                    $incident->recommendation = $o->recomendation;

                    //Detection and Occurrence times
                    $detTime = $this->query('SELECT * FROM time WHERE time_types_id=1 AND incidents_id=' . $o->id);
                    if (sizeof($detTime) > 0)
                        $incident->occurrence_time = $detTime[0]->datetime;
                    else
                        $incident->occurrence_time = $o->created_at;

                    $occTime = $this->query('SELECT * FROM time WHERE time_types_id=2 AND incidents_id=' . $o->id);
                    if (sizeof($occTime) > 0)
                        $incident->detection_time = $occTime[0]->datetime;
                    else
                        $incident->detection_time = $o->created_at;

                    $r = $this->query('SELECT link FROM public.references WHERE incidents_id=' . $o->id . ' LIMIT 1');
                    if (sizeof($r) > 0)
                        $incident->reference = $r[0]->link;
                    else
                        $incident->reference = 'SD';

                    $incident->attack_type_id = $o->attacks_id;

                    $criticity = Criticity::whereName($o->criticity)->first();
                    if ($criticity)
                        $incident->criticity_id = $criticity->id;
                    else
                        $incident->criticity_id = 2;
                    if ($o->impact)
                        $incident->impact = $o->impact;
                    else
                        $incident->impact = 5;
                    if ($o->risk)
                        $incident->risk = $o->risk;
                    else
                        $incident->risk = 5;
                    $incident->customer_id = $o->customers_id;

                    $flow = AttackFlow::whereName($o->stream)->first();
                    $incident->attack_flow_id = $flow->id;
                    $incident->save();

                    $no_ticket = $this->tickets($o);

                    if ($no_ticket) {
                        array_push($newtickets, $no_ticket);
                    }

                    //IncidentEvidence
                    $images = $this->query('SELECT * FROM images WHERE incidents_id=' . $o->id);
                    foreach ($images as &$image) {
                        $evidence = new Evidence();
                        $this->modelTimestamps($evidence, $image);
                        $evidence->mime_type = 'unknow';
                        $evidence->path = 'files/evidence';
                        $evidence->name = $image->name;
                        $evidence->original_name = $image->name;
                        $evidence->md5 = $image->md5;
                        $evidence->sha1 = $image->sha1;
                        $evidence->sha256 = $image->sha256;
                        $evidence->save();

                        $iEvidence = new IncidentEvidence();
                        $this->modelTimestamps($iEvidence, $image);
                        $iEvidence->evidence_id = $evidence->id;
                        $iEvidence->incident_id = $o->id;
                        switch ($image->evidence_types_id) {
                            case 1:
                                $iEvidence->evidence_type_id = 2;
                                break;
                            case 2:
                                $iEvidence->evidence_type_id = 3;
                                break;
                            case 3:
                                $iEvidence->evidence_type_id = 4;
                                break;
                        }
                        $iEvidence->user_id = $o->incident_handler_id;
                        $iEvidence->save();
                    }


                    //IncidentEvent
                    $incident_occurrences = $this->query('SELECT * FROM incidents_occurences WHERE incidents_id=' . $o->id);
                    foreach ($incident_occurrences as &$io) {
                        $source = $this->query('SELECT * FROM occurrences WHERE id=' . $io->source_id);
                        $target = $this->query('SELECT * FROM occurrences WHERE id=' . $io->destiny_id);

                        $source = $source[0];
                        $target = $target[0];

                        $source_oh = $this->query('SELECT * FROM occurences_history WHERE occurences_id=' . $source->id . ' AND to_char(created_at,\'YYYY-MM-DD HH24:MI\')=\'' . date('Y-m-d H:i', strtotime($o->created_at)) . '\'');
                        if (is_array($source_oh)) {
                            if (sizeof($source_oh) == 0) {
                                $source_oh = $this->query('SELECT * FROM occurences_history WHERE occurences_id=' . $source->id);
                            }
                            $source_oh = $source_oh[0];
                        }

                        //Creamos el Asset Source
                        $sourceAsset = Asset::whereIpv4(trim($source->ip))->first();
                        if (!$sourceAsset) {
                            $sourceAsset = new Asset();
                            $this->modelTimestamps($sourceAsset, $source);
                            $sourceAsset->ipv4 = trim($source->ip);
                            $sourceAsset->user_id = $source_oh->incident_handler_id;
                            $sourceAsset->save();
                        }

                        $smachine = new Machine();
                        $this->modelTimestamps($smachine, $source_oh);
                        $smachine->os = $source_oh->operative_system;
                        $smachine->port = $source_oh->port;
                        $smachine->protocol = $source_oh->protocol;
                        $smachine->hide = !$source->show;
                        $smachine->blacklist = $source->blacklist;
                        if ($source->location != null || $source->location != '' || $source->location != ' ') {
                            $location = \DB::connection('pgsql')->select(\DB::raw('SELECT id FROM location WHERE name LIKE \'' . $source->location . '\''));
                            if (sizeof($location) > 0)
                                $smachine->location_id = $location[0]->id;
                        }
                        $smachine->machine_type_id = $source->occurrences_types_id;
                        $smachine->asset_id = $sourceAsset->id;
                        $smachine->save();

                        $target_oh = $this->query('SELECT * FROM occurences_history WHERE occurences_id=' . $target->id . ' AND to_char(created_at,\'YYYY-MM-DD HH24:MI\')=\'' . date('Y-m-d H:i', strtotime($o->created_at)) . '\'');
                        if (is_array($target_oh)) {
                            if (sizeof($target_oh) == 0) {
                                $target_oh = $this->query('SELECT * FROM occurences_history WHERE occurences_id=' . $target->id);
                            }
                            $target_oh = $target_oh[0];
                        }
                        //Creamos el Asset Target
                        $targetAsset = Asset::whereIpv4(trim($target->ip))->first();
                        if (!$targetAsset) {
                            $targetAsset = new Asset();
                            $this->modelTimestamps($targetAsset, $target);
                            $targetAsset->ipv4 = trim($target->ip);
                            $targetAsset->user_id = $target_oh->incident_handler_id;
                            $targetAsset->save();
                        }

                        $tmachine = new Machine();
                        $this->modelTimestamps($tmachine, $target_oh);
                        $tmachine->os = $target_oh->operative_system;
                        $tmachine->port = $target_oh->port;
                        $tmachine->protocol = $target_oh->protocol;
                        $tmachine->hide = !$target->show;
                        $tmachine->blacklist = $target->blacklist;

                        if ($target->location) {
//                        $location = $this->query('SELECT id FROM location WHERE name LIKE \'%' . $target->location . '%\'');
                            $location = \DB::connection('pgsql')->select(\DB::raw('SELECT id FROM location WHERE name LIKE \'' . $target->location . '\''));
                            if (sizeof($location) > 0)
                                $tmachine->location_id = $location[0]->id;
                        }

                        $tmachine->machine_type_id = $target->occurrences_types_id;
                        $tmachine->asset_id = $targetAsset->id;
                        $tmachine->save();

                        $iEvent = new IncidentEvent();
                        $this->modelTimestamps($iEvent, $io);
                        $iEvent->incident_id = $o->id;
                        $iEvent->source_machine_id = $smachine->id;
                        $iEvent->target_machine_id = $tmachine->id;
                        $iEvent->user_id = $o->incident_handler_id;
                        $iEvent->event_relation = 'ol';
                        $iEvent->save();
                    }

                    //Annexes
                    $oAnnexes = $this->query('SELECT * FROM annexes WHERE incidents_id=' . $o->id);
                    foreach ($oAnnexes as &$oA) {
                        $a = new Annex();
                        $this->modelTimestamps($a, $oA);
                        $a->title = $oA->title;
                        $a->field = $oA->field;
                        $a->content = $oA->content;
                        $a->incident_id = $oA->incidents_id;
                        $a->user_id = $oA->incident_handler_id;
                        $a->save();
                    }


                    //IncidentAttackCategory
                    $iCategory = new IncidentAttackCategory();
                    $this->modelTimestamps($iCategory, $o);
                    $iCategory->incident_id = $o->id;
                    $iCategory->attack_category_id = $o->categories_id;
                    $iCategory->user_id = $o->incident_handler_id;
                    $iCategory->save();

                    $oldCategories = $this->query('SELECT * FROM extra_category WHERE incidents_id=' . $o->id);
                    foreach ($oldCategories as &$oC) {
                        $nC = new IncidentAttackCategory();
                        $this->modelTimestamps($nC, $oC);
                        $nC->incident_id = $oC->incidents_id;
                        $nC->attack_category_id = $oC->category_id;
                        $nC->user_id = $o->incident_handler_id;
                        $nC->save();
                    }

                    //IncidentCustomerSensor
                    $iSensor = new IncidentCustomerSensor();
                    $this->modelTimestamps($iSensor, $o);
                    $iSensor->incident_id = $o->id;
                    $iSensor->customer_sensor_id = $o->sensors_id;
                    $iSensor->user_id = $o->incident_handler_id;
                    $iSensor->save();

                    $oldSensors = $this->query('SELECT * FROM extra_sensor WHERE incidents_id=' . $o->id);
                    foreach ($oldSensors as &$oS) {
                        $nS = new IncidentCustomerSensor();
                        $this->modelTimestamps($nS, $oS);
                        $nS->incident_id = $oS->incidents_id;
                        $nS->customer_sensor_id = $oS->sensor_id;
                        $nS->user_id = $o->incident_handler_id;
                        $nS->save();
                    }

                    $this->signaturesForIncident($o);

                    //IncidentHistory
                    $descriptions = $this->query('SELECT * FROM incident_descriptions WHERE incidents_id=' . $o->id);
                    foreach ($descriptions as &$d) {
                        $ih = new History();
                        $this->modelTimestamps($ih, $d);
                        $ih->description = $d->description;
                        $ih->incident_id = $d->incidents_id;
                        $ih->user_id = $d->incident_handler_id;
                        $ih->save();
                    }

                    //Notes
                    $observations = $this->query('SELECT * FROM observations WHERE incidents_id=' . $o->id);
                    foreach ($observations as &$ob) {
                        $note = new Note();
                        $this->modelTimestamps($note, $ob);
                        $note->user_id = $ob->incident_handler_id;
                        $note->content = $ob->content;
                        $note->incident_id = $o->id;
                        if (isset($o->readed))
                            $note->read_by = $o->readed;
                        if (isset($o->attended))
                            $note->attended_by = $o->attended;
                        $note->save();
                    }
                } catch (\Exception $e) {
                    $this->showError($e, 'incidente', $o->id);
                    //return;
                } finally {
                    $bar->advance();
                }
            }

            $bar->finish();
            $this->alterSequence($olds, 'incident');
            $this->alterSequence($this->query('SELECT * FROM tickets'), 'ticket');
            $this->saveEmptyTickets($newtickets);

        }
    }

    /**
     * Genera las firmas que no hayan sido creadas, con base en aquellas dadas de alta en la tabla de 'rules' de la base de datos vieja
     */
    private function rules()
    {
        $oRules = $this->query('SELECT * FROM rules ORDER BY message ASC');
        $finalCount = 0;
        foreach ($oRules as &$r) {
            $count = AttackSignature::whereRaw('name=\'' . trim($r->message) . '\'')->count();
            if ($count == 0) {
                $signature = new AttackSignature();
                $this->modelTimestamps($signature, $r);
                $signature->name = trim($r->message);
                $signature->save();
                $finalCount++;
            }
        }
        $this->info("Se migraron $finalCount firmas sin datos de descripción y demás");
    }

    /**
     * Ejecuta una query raw para obtener una lista de elementos de la vieja base de datos
     *
     * @param $query
     * @return array
     */
    private function query($query)
    {
        return \DB::connection('old_pgsql')->select(\DB::raw($query));
    }

    /**
     * Altera una secuencia con el consecutivo siguiente, después de hacer una migración
     *
     * @param $array
     * @param $sequence
     * @return bool
     */
    private function alterSequence($array, $sequence)
    {
        $lastId = 0;
        foreach ($array as &$a) {
            if ($a->id > $lastId) {
                $lastId = $a->id;
            }
        }
        $lastId += 1;
        $sequence .= '_id_seq';
        $this->info($sequence . ":" . $lastId);

        return \DB::connection('pgsql')->statement("ALTER SEQUENCE $sequence RESTART WITH $lastId");
    }

    /**
     * Mapea los campos de timestamps de laravel de creado, actualizado y eliminado
     *
     * @param $new
     * @param $old
     */
    private function modelTimestamps(&$new, &$old)
    {
        if (isset($old->created_at))
            $new->created_at = date('Y-m-d H:i:s', strtotime($old->created_at));
        if (isset($old->deleted_at))
            $new->updated_at = date('Y-m-d H:i:s', strtotime($old->updated_at));
        if (isset($old->deleted_at))
            $new->deleted_at = date('Y-m-d H:i:s', strtotime($old->deleted_at));
    }

    /**
     * Migra todos los tickets del incidente $old_incident
     *
     * @param $old_incident
     * @return Ticket
     */
    private function tickets($old_incident)
    {
        //Tickets (No debería de haber más de un ticket en el sistema, pero...)
        $oldTickets = $this->query('SELECT * FROM tickets WHERE incidents_id=' . $old_incident->id);

        if (sizeof($oldTickets) > 0)
            foreach ($oldTickets as &$oT) {
                $ticket = new Ticket();
                $this->modelTimestamps($ticket, $oT);
                $ticket->id = $oT->id;
                $ticket->otrs_ticket_id = $oT->otrs_ticket_id;
                $ticket->otrs_ticket_number = $oT->otrs_ticket_number;
                $ticket->internal_number = $oT->internal_number;
                $ticket->send_reminder = $oT->reminder_sended;
                $ticket->user_id = $oT->incident_handler_id;
                $ticket->incident_id = $old_incident->id;
                $ticket->ticket_status_id = $old_incident->incidents_status_id;
                $ticket->save();
            }
        else {
            $ticket = new Ticket();
            $this->modelTimestamps($ticket, $old_incident);
            $ticket->user_id = $old_incident->incident_handler_id;
            $ticket->incident_id = $old_incident->id;
            $ticket->internal_number = 'Por asignar...';
            $ticket->ticket_status_id = 1;

            return $ticket;
        }
    }

    /**
     * Almacena los tickets que no estaban asignados a un incidente
     *
     * @param array $newtickets : Tickets que no están asignados a un incidente
     */
    private function saveEmptyTickets(array $newtickets)
    {
        foreach ($newtickets as $newticket) {
            $newticket->save();
        }
    }
}
