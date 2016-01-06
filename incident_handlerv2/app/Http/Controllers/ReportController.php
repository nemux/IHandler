<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Library\CsvGenerator;
use App\Library\WordGenerator;
use Models\IncidentManager\Catalog\AttackCategory;
use Models\IncidentManager\Catalog\Criticity;
use Models\IncidentManager\Customer\Customer;
use Models\IncidentManager\Customer\CustomerSensor;
use Models\IncidentManager\Incident\Incident;
use Models\IncidentManager\Ticket\TicketStatus;
use Models\IncidentManager\User\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    private $from_date;
    private $to_date;
    private $customer_id;
    private $sensor_id;
    private $excelude_open_tickets;
    private $list;

    public function incidentReport($report_type)
    {
        switch ($report_type) {
            case 'date':
            case 'handler':
            case 'category':
            case 'criticity':
            case 'status':
            case 'ip':
            case 'csv':
                return view('report.incident')->withType($report_type);
                break;
            default:
                abort(404);
        }
    }

    public function incidentReportPost(Request $request, $report_type)
    {
        $initdate = new \DateTime();

        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');

        if ($from_date == '' || $to_date == '') {
            return redirect()->route('report.incident', $report_type)->withErrors(['Los campos de fecha no pueden estar vacíos']);
        }

        $this->from_date = date('Y-m-d 00:00:00', strtotime(str_replace('/', '-', $request->get('from_date'))));
        $this->to_date = date('Y-m-d 23:59:59', strtotime(str_replace('/', '-', $request->get('to_date'))));
        $this->customer_id = $request->get('customer');
        $this->sensor_id = $request->get('sensor');
        $this->excelude_open_tickets = $request->get('no-open');
        $this->list = $request->get('list-items');

        $headers = array(
            "Content-Type" => "application/vnd.ms-word;charset=utf-8",
            "Content-Disposition" => "attachment;Filename=Incidentes{$request->get('from_date')}-{$request->get('to_date')}.docx"
        );

        $file = null;
        switch ($report_type) {
            case 'date':
                $file = $this->generateByDate();
                break;
            case 'handler':
                $file = $this->generateByHandler($request->get('user'));
                break;
            case 'category':
                $file = $this->generateByCategory($request->get('category'));
                break;
            case 'criticity':
                $file = $this->generateByCriticity($request->get('criticity'));
                break;
            case 'status':
                $file = $this->generateByStatus($request->get('status'));
                break;
            case 'ip':
                $file = $this->generateByIP($request->get('ip'), $request->get('eventside'));
                break;
            case 'csv':
                $headers = array(
                    "Content-Type" => "application/vnd.ms-excel;charset=utf-8",
                    "Content-Disposition" => "attachment;Filename=Incidentes{$request->get('from_date')}-{$request->get('to_date')}.xlsx"
                );

                $file = $this->generateCsv();
                break;
            default:
                abort(404);
        }

        $interval = $initdate->diff(new \DateTime());

        \Log::info("Tiempo transcurrido " . $interval->i . " minutos " . $interval->s . " segundos");

        return \Response::make($file, 200, $headers);
    }

    /**
     * Genera el reporte básico, con un rango de fechas, con o sin clientes y con o sin sensores
     *
     * @return string
     */
    private function generateByDate()
    {
        $doc = new  WordGenerator(Incident::class, WordGenerator::TYPE_LIST);

        if ($this->customer_id == '') {
            $customers = Customer::orderBy('name')->get(['id', 'name']);
        } else {
            $customers = Customer::whereId($this->customer_id)->get(['id', 'name']);
        }

        foreach ($customers as $customer) {
            $doc->addTitle("Cliente: " . $customer->name, 1);

            if ($this->sensor_id == '') {
                $sensors = CustomerSensor::whereCustomerId($customer->id)->orderBy('name')->get(['id', 'name']);
            } else {
                $sensors = CustomerSensor::whereId($this->sensor_id)->orderBy('name')->get(['id', 'name']);
            }

            foreach ($sensors as $sensor) {
                $doc->addTitle("Sensor: " . $sensor->name, 2);

                $query = Incident::whereCustomerId($customer->id)
                    ->whereBetween('incident.detection_time', [$this->from_date, $this->to_date]);

                if ($this->excelude_open_tickets) {
                    $query->whereExists(function ($query) {
                        $query->select(\DB::raw(1))->from('ticket')->whereRaw('ticket.incident_id=incident.id and ticket.ticket_status_id>=2');
                    });
                }

                $incidents = $query->get();

                foreach ($incidents as $incident) {
                    if ($incident->sensors->first()->customer_sensor_id == $sensor->id) {
                        if ($this->list)
                            $doc->addIncidentListItem($incident);
                        else
                            $doc->addIncidentTable($incident);
                    }
                }
            }
        }

        return $doc->streamDocument();
    }

    /**
     * Genera el reporte de incidentes separando los elementos por Handler (Usuario)
     *
     * @param $user_id
     * @return string
     */
    private function generateByHandler($user_id)
    {
        $doc = new  WordGenerator(Incident::class, WordGenerator::TYPE_LIST);

        if ($this->customer_id == '') {
            $customers = Customer::orderBy('name')->get(['id', 'name']);
        } else {
            $customers = Customer::whereId($this->customer_id)->get(['id', 'name']);
        }

        foreach ($customers as $customer) {
            $doc->addTitle("Cliente: " . $customer->name, 1);

            if ($this->sensor_id == '') {
                $sensors = CustomerSensor::whereCustomerId($customer->id)->orderBy('name')->get(['id', 'name']);
            } else {
                $sensors = CustomerSensor::whereId($this->sensor_id)->orderBy('name')->get(['id', 'name']);
            }

            foreach ($sensors as $sensor) {
                $doc->addTitle("Sensor: " . $sensor->name, 2);

                if ($user_id == '') {
                    $users = User::all();
                } else {
                    $users = User::whereId($user_id)->get();
                }

                foreach ($users as $user) {
                    $doc->addTitle("Handler: " . $user->person->fullName(), 3);

                    $query = Incident::whereCustomerId($customer->id)
                        ->whereUserId($user->id)
                        ->whereBetween('incident.detection_time', [$this->from_date, $this->to_date]);

                    if ($this->excelude_open_tickets) {
                        $query->whereExists(function ($query) {
                            $query->select(\DB::raw(1))->from('ticket')->whereRaw('ticket.incident_id=incident.id and ticket.ticket_status_id>=2');
                        });
                    }

                    $incidents = $query->get();

                    foreach ($incidents as $incident) {
                        if ($incident->sensors->first()->customer_sensor_id == $sensor->id) {
                            if ($this->list)
                                $doc->addIncidentListItem($incident);
                            else
                                $doc->addIncidentTable($incident);
                        }
                    }

                }
            }
        }

        return $doc->streamDocument();
    }

    /**
     * Genera el reporte de incidentes separando los elementos por categoría
     *
     * @param $category_id
     * @return string
     */
    private function generateByCategory($category_id)
    {
        $doc = new  WordGenerator(Incident::class, WordGenerator::TYPE_LIST);

        if ($this->customer_id == '') {
            $customers = Customer::orderBy('name')->get(['id', 'name']);
        } else {
            $customers = Customer::whereId($this->customer_id)->get(['id', 'name']);
        }

        foreach ($customers as $customer) {
            $doc->addTitle("Cliente: " . $customer->name, 1);

            if ($this->sensor_id == '') {
                $sensors = CustomerSensor::whereCustomerId($customer->id)->orderBy('name')->get(['id', 'name']);
            } else {
                $sensors = CustomerSensor::whereId($this->sensor_id)->orderBy('name')->get(['id', 'name']);
            }

            foreach ($sensors as $sensor) {
                $doc->addTitle("Sensor: " . $sensor->name, 2);

                if ($category_id == '') {
                    $categories = AttackCategory::all();
                } else {
                    $categories = AttackCategory::whereId($category_id)->get();
                }

                foreach ($categories as $category) {
                    $doc->addTitle("Categoría: " . $category->name, 3);

                    $query = Incident::whereCustomerId($customer->id)
                        ->whereUserId($category->id)
                        ->whereBetween('incident.detection_time', [$this->from_date, $this->to_date]);

                    if ($this->excelude_open_tickets) {
                        $query->whereExists(function ($query) {
                            $query->select(\DB::raw(1))->from('ticket')->whereRaw('ticket.incident_id=incident.id and ticket.ticket_status_id>=2');
                        });
                    }

                    $incidents = $query->get();

                    foreach ($incidents as $incident) {
                        if (
                            $incident->sensors->first()->customer_sensor_id == $sensor->id
                            && $incident->categories->first()->attack_category_id == $category->id
                        ) {
                            if ($this->list)
                                $doc->addIncidentListItem($incident);
                            else
                                $doc->addIncidentTable($incident);
                        }
                    }

                }
            }
        }

        return $doc->streamDocument();
    }

    /**
     * Genera el documento de reporte separando los elementos por criticidad
     *
     * @param $criticity_id
     * @return string
     */
    private function generateByCriticity($criticity_id)
    {
        $doc = new  WordGenerator(Incident::class, WordGenerator::TYPE_LIST);

        if ($this->customer_id == '') {
            $customers = Customer::orderBy('name')->get(['id', 'name']);
        } else {
            $customers = Customer::whereId($this->customer_id)->get(['id', 'name']);
        }

        foreach ($customers as $customer) {
            $doc->addTitle("Cliente: " . $customer->name, 1);

            if ($this->sensor_id == '') {
                $sensors = CustomerSensor::whereCustomerId($customer->id)->orderBy('name')->get(['id', 'name']);
            } else {
                $sensors = CustomerSensor::whereId($this->sensor_id)->orderBy('name')->get(['id', 'name']);
            }

            foreach ($sensors as $sensor) {
                $doc->addTitle("Sensor: " . $sensor->name, 2);

                if ($criticity_id == '') {
                    $criticities = Criticity::all('id', 'name');
                } else {
                    $criticities = Criticity::whereId($criticity_id)->get(['id', 'name']);
                }

                foreach ($criticities as $criticity) {
                    $doc->addTitle("Severidad: " . $criticity->name, 3);

                    $query = Incident::whereCustomerId($customer->id)
                        ->whereCriticityId($criticity->id)
                        ->whereBetween('incident.detection_time', [$this->from_date, $this->to_date]);

                    if ($this->excelude_open_tickets) {
                        $query->whereExists(function ($query) {
                            $query->select(\DB::raw(1))->from('ticket')->whereRaw('ticket.incident_id=incident.id and ticket.ticket_status_id>=2');
                        });
                    }

                    $incidents = $query->get();

                    foreach ($incidents as $incident) {
                        if ($incident->sensors->first()->customer_sensor_id == $sensor->id) {
                            if ($this->list)
                                $doc->addIncidentListItem($incident);
                            else
                                $doc->addIncidentTable($incident);
                        }
                    }

                }
            }
        }

        return $doc->streamDocument();
    }

    /**
     * Agrega los incidentes al reporte, separándolos por estatus
     *
     * @param $status_id
     * @return string
     */
    private function generateByStatus($status_id)
    {
        $doc = new  WordGenerator(Incident::class, WordGenerator::TYPE_LIST);

        if ($this->customer_id == '') {
            $customers = Customer::orderBy('name')->get(['id', 'name']);
        } else {
            $customers = Customer::whereId($this->customer_id)->get(['id', 'name']);
        }

        foreach ($customers as $customer) {
            $doc->addTitle("Cliente: " . $customer->name, 1);

            if ($this->sensor_id == '') {
                $sensors = CustomerSensor::whereCustomerId($customer->id)->orderBy('name')->get(['id', 'name']);
            } else {
                $sensors = CustomerSensor::whereId($this->sensor_id)->orderBy('name')->get(['id', 'name']);
            }

            foreach ($sensors as $sensor) {
                $doc->addTitle("Sensor: " . $sensor->name, 2);

                if ($status_id == '') {
                    $statuses = TicketStatus::all('id', 'name');
                } else {
                    $statuses = TicketStatus::whereId($status_id)->get(['id', 'name']);
                }

                foreach ($statuses as $status) {
                    $doc->addTitle("Estatus: " . $status->name, 3);

                    $query = Incident::whereCustomerId($customer->id)
                        ->whereBetween('incident.detection_time', [$this->from_date, $this->to_date])
                        ->whereExists(function ($query) use ($status) {
                            $query->select(\DB::raw(1))->from('ticket')->whereRaw("ticket.incident_id=incident.id and ticket.deleted_at is null and ticket.ticket_status_id={$status->id}");
                        });

                    if ($this->excelude_open_tickets) {
                        $query->whereExists(function ($query) {
                            $query->select(\DB::raw(1))->from('ticket')->whereRaw('ticket.incident_id=incident.id and ticket.ticket_status_id>=2');
                        });
                    }

                    $incidents = $query->get();

                    foreach ($incidents as $incident) {
                        if ($incident->sensors->first()->customer_sensor_id == $sensor->id) {
                            if ($this->list)
                                $doc->addIncidentListItem($incident);
                            else
                                $doc->addIncidentTable($incident);
                        }
                    }

                }
            }
        }

        return $doc->streamDocument();
    }

    /**
     * Genera el reporte de incidentes que contienen la o las ips en $ips
     *
     * NOTA: $ips puede ser un string separado por comas, tomar eso en cuenta
     *
     * @param $ips
     * @param $eventside
     *
     * @return null
     */
    private function generateByIP($ips, $eventside)
    {
        $ips_array = explode(',', $ips);

        $doc = new  WordGenerator(Incident::class, WordGenerator::TYPE_LIST);

        if ($this->customer_id == '') {
            $customers = Customer::orderBy('name')->get(['id', 'name']);
        } else {
            $customers = Customer::whereId($this->customer_id)->get(['id', 'name']);
        }

        foreach ($customers as $customer) {
            $doc->addTitle("Cliente: " . $customer->name, 1);

            if ($this->sensor_id == '') {
                $sensors = CustomerSensor::whereCustomerId($customer->id)->orderBy('name')->get(['id', 'name']);
            } else {
                $sensors = CustomerSensor::whereId($this->sensor_id)->orderBy('name')->get(['id', 'name']);
            }

            foreach ($sensors as $sensor) {
                $doc->addTitle("Sensor: " . $sensor->name, 2);

                foreach ($ips_array as $ip) {
                    $ip = trim($ip);

                    $doc->addTitle("IP: " . $ip, 3);

                    $query = Incident::select(\DB::raw('incident.*'))
                        ->whereCustomerId($customer->id)
                        ->whereBetween('incident.detection_time', [$this->from_date, $this->to_date])
                        ->leftJoin('incident_event', 'incident_event.incident_id', '=', 'incident.id');
                    if ($eventside == 'source')
                        $query->leftJoin('machine', 'machine.id', '=', 'incident_event.source_machine_id');
                    else if ($eventside == 'target')
                        $query->leftJoin('machine', 'machine.id', '=', 'incident_event.target_machine_id');
                    else
                        $query->leftJoin('machine', function ($join) {
                            $join->on('machine.id', '=', 'incident_event.source_machine_id')
                                ->orOn('machine.id', '=', 'incident_event.target_machine_id');
                        });

                    $query = $query->leftJoin('asset', 'asset.id', '=', 'machine.asset_id')
                        ->where('asset.ipv4', '=', $ip);

                    if ($this->excelude_open_tickets) {
                        $query->whereExists(function ($query) {
                            $query->select(\DB::raw(1))->from('ticket')->whereRaw('ticket.incident_id=incident.id and ticket.ticket_status_id>=2');
                        });
                    }

                    $incidents = $query->get();

                    foreach ($incidents as $incident) {

                        if ($incident->sensors->first()->customer_sensor_id == $sensor->id) {
                            if ($this->list)
                                $doc->addIncidentListItem($incident);
                            else
                                $doc->addIncidentTable($incident);
                        }
                    }

                }
            }
        }

        return $doc->streamDocument();
    }

    private function generateCsv()
    {
        $doc = new CsvGenerator(Incident::class);

        if ($this->customer_id == '') {
            $customers = Customer::orderBy('name')->get(['id', 'name']);
        } else {
            $customers = Customer::whereId($this->customer_id)->get(['id', 'name']);
        }

        foreach ($customers as $customer) {
            if ($this->sensor_id == '') {
                $sensors = CustomerSensor::whereCustomerId($customer->id)->orderBy('name')->get(['id', 'name']);
            } else {
                $sensors = CustomerSensor::whereId($this->sensor_id)->orderBy('name')->get(['id', 'name']);
            }

            foreach ($sensors as $sensor) {
                $query = Incident::whereCustomerId($customer->id)
                    ->whereBetween('incident.detection_time', [$this->from_date, $this->to_date]);

                if ($this->excelude_open_tickets) {
                    $query->whereExists(function ($query) {
                        $query->select(\DB::raw(1))->from('ticket')->whereRaw('ticket.incident_id=incident.id and ticket.ticket_status_id>=2');
                    });
                }

                $incidents = $query->get();

                foreach ($incidents as $incident) {
                    if ($incident->sensors->first()->customer_sensor_id == $sensor->id) {
                        $doc->addIncident($incident);
                    }
                }
            }
        }

        return $doc->streamDocument();
    }
}
