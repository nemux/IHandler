<?php

class StatsController extends Controller
{
    protected $layout = 'layouts.master';

    /**
     * Muestra el perfil de un usuario dado.
     */
    public function incident()
    {

        return $this->layout = View::make("stats.incident", array());

    }

    public function incidentGraph()
    {
        $input = Input::all();
        $option = $input['option'];
        $incidents = null;


        if ($input['start'] != '' && $input['end'] != '') {
            $start = explode("/", $input['start'])[2] . "-" . explode("/", $input['start'])[0] . "-" . explode("/", $input['start'])[1];
            $end = explode("/", $input['end'])[2] . "-" . explode("/", $input['end'])[0] . "-" . explode("/", $input['end'])[1];
            $sensor = "";
            if ($input['sensor'] != "") {
                $sensor = "and i.sensors_id=" . $input['sensor'];
            }
            if ($option == 1) {

                $incidents = DB::select(DB::raw(" select count(*), extract(month from t.datetime) as month
                                              from incidents as i, time as t
                                              where i.id=t.incidents_id and
                                              t.time_types_id=1
                                              and i.customers_id=" . $input['customer'] . "
                                              " . $sensor . "
                                              and t.datetime between '" . $start . " 00:00:00' and '" . $end . " 23:59:59'
                                              group by month order by month asc"));
            } else if ($option == 2) {

                if ($input['overlap'] == 2) {
                    $incidents = DB::select(DB::raw(" select count(*), date_trunc('day',t.datetime) as date
                                                from incidents as i, time as t
                                                where i.id=t.incidents_id and
                                                t.time_types_id=1
                                                and i.customers_id=" . $input['customer'] . "
                                                " . $sensor . "
                                                and t.datetime between '" . $start . " 00:00:00' and '" . $end . " 23:59:59'
                                                group by date order by date asc"));
                } else if ($input['overlap'] == 1) {
                    $months = DB::select(DB::raw("    select count(*), extract(month from t.datetime) as month,extract(year from t.datetime) as year
                                                from incidents as i, time as t
                                                where i.id=t.incidents_id and
                                                t.time_types_id=1
                                                and i.customers_id=" . $input['customer'] . "
                                                " . $sensor . "
                                                and t.datetime between '" . $start . " 00:00:00' and '" . $end . " 23:59:59'
                                                group by month,year order by month,year asc"));

                    $incidents = DB::select(DB::raw(" select count(*), date_trunc('day',t.datetime) as date
                                                from incidents as i, time as t
                                                where i.id=t.incidents_id and
                                                t.time_types_id=1
                                                and i.customers_id=" . $input['customer'] . "
                                                " . $sensor . "
                                                and t.datetime between '" . $start . " 00:00:00' and '" . $end . " 23:59:59'
                                                group by date order by date asc"));
                    return $this->layout = View::make("stats._incident_overlap", array(
                        'incidents' => $incidents,
                        'option' => $option,
                        'overlap' => "0",
                        'months' => $months,
                        'sensor' => $input['sensor'],
                    ));
                }

            }
            return $this->layout = View::make("stats._incident", array(
                'incidents' => $incidents,
                'option' => $option,
                'sensor' => $input['sensor'],
            ));
        }


    }

    public function ip()
    {

        return $this->layout = View::make("stats.ip", array());

    }

    public function ipGraph()
    {
        $input = Input::all();

        //print_r($input);
        if ($input['top'] != '' && $input['src_dst'] != '' && $input['customer'] != '' && $input['blacklist'] != "") {

            $top = $input['top'];
            $src_dst = $input['src_dst'];
            $customer = $input['customer'];
            $blacklist = $input['blacklist'];
            $join_occurence = "";
            $set_blacklist = "";
            if ($input['src_dst'] == 1)
                $join_occurence = "io.source_id";
            else if ($input['src_dst'] == 2)
                $join_occurence = "io.destiny_id";


            if ($blacklist == 0) {
                $set_blacklist = "FALSE";
            } else if ($blacklist == 1) {
                $set_blacklist = "TRUE";
            }
            $start = explode("/", $input['start'])[2] . "-" . explode("/", $input['start'])[0] . "-" . explode("/", $input['start'])[1];
            $end = explode("/", $input['end'])[2] . "-" . explode("/", $input['end'])[0] . "-" . explode("/", $input['end'])[1];
            /*$query1="select
                                            o.ip as ip,
                                            count(o.id)
                                          from
                                            occurrences as o
                                          where
                                            o.ip not like ''
                                          and
                                            o.blacklist=".$set_blacklist."
                                          and
                                            o.created_at between '".$start." 00:00:00' and '".$end." 23:59:59'
                                          and
                                            o.id=(
                                              select ".$join_occurence." from
                                                incidents_occurences as io,
                                                incidents as i,
                                                customers as c
                                              where
                                                ".$join_occurence."=o.id
                                              and
                                                io.incidents_id=i.id
                                              and
                                                c.id=".$customer."
                                              and
                                                i.customers_id=c.id limit 1)
                                          group by
                                            ip
                                          order by
                                            count desc
                                          limit ".$top."
                                          ";*/
            $query = "select
                    o.ip as ip,
                    count(o.ip)
                  from
                    incidents as i,
                    time as t,
                    incidents_occurences as io,
                    occurrences as o
                  where
                    t.time_types_id=1
                  and
                    t.incidents_id=i.id
                  and
                    t.datetime between '" . $start . " 00:00:00' and '" . $end . " 23:59:59'
                  and
                    io.incidents_id=i.id
                  and
                    " . $join_occurence . "=o.id
                  and
                    o.ip not like ''
                  and
                    o.blacklist=" . $set_blacklist . "
                  and
                    i.customers_id=" . $customer . "
                  group by
                    ip
                  order by
                    count desc
                  limit " . $top . ";
                  ";

            $ips = DB::select(DB::raw($query));

            return $this->layout = View::make("stats._ip", array(
                'ips' => $ips,
                'top' => $top,
                'src_dst' => $src_dst,
                'customer' => $customer,
                'blacklist' => $blacklist,

            ));
        }
    }


    public function attack()
    {
        return $this->layout = View::make("stats.attack", array());
    }

    public function attackGraph()
    {
        $input = Input::all();

        Log::info('lala');

        if ($input['start'] != '' && $input['end'] != '') {
            $start = explode("/", $input['start'])[2] . "-" . explode("/", $input['start'])[0] . "-" . explode("/", $input['start'])[1];
            $end = explode("/", $input['end'])[2] . "-" . explode("/", $input['end'])[0] . "-" . explode("/", $input['end'])[1];
            $customer = $input['customer'];
            $query = " select
                                            count(*) as total,
                                            a.name as attack
                                          from
                                            incidents as i,
                                            attacks as a,
                                            time as t
                                          where
                                            i.customers_id=" . $customer . "
                                          and
                                            i.attacks_id=a.id
                                          and
                                            i.incidents_status_id>1
                                          and
                                            t.time_types_id=1
                                          and
                                            t.incidents_id=i.id
                                          and
                                            i.sensors_id=" . $input['sensor'] . "
                                          and
                                            t.datetime between '" . $start . " 00:00:00' and '" . $end . " 23:59:59'
                                          and
                                            a.name!='Attack'
                                          group by
                                            a.name
                                          order by
                                            total desc
                                          ;
                                            ";
            try {
                Log::info($query);
                $incidents = DB::select(DB::raw($query));
            } catch (Exception $e) {
                Log::error($e);
            }
            return $this->layout = View::make("stats._attack", array(
                'incidents' => $incidents,
                'sensor_name' => $input['nombre_sensor']
            ));
        }
    }

    public function category()
    {

        return $this->layout = View::make("stats.category", array());

    }

    public function categoryGraph()
    {
        $input = Input::all();

        //print_r($input);
        if ($input['start'] != '' && $input['end'] != '') {
            $start = explode("/", $input['start'])[2] . "-" . explode("/", $input['start'])[0] . "-" . explode("/", $input['start'])[1];
            $end = explode("/", $input['end'])[2] . "-" . explode("/", $input['end'])[0] . "-" . explode("/", $input['end'])[1];
            $customer = $input['customer'];
            $incidents = DB::select(DB::raw(" select
                                            count(*) as total,
                                            c.name as category
                                          from
                                            incidents as i,
                                            categories as c,
                                            time as t
                                          where
                                            i.customers_id=" . $customer . "
                                          and
                                            i.categories_id=c.id
                                          and
                                            i.incidents_status_id>1
                                          and
                                            t.time_types_id=1
                                          and
                                            t.incidents_id=i.id
                                          and
                                            i.sensors_id=" . $input['sensor'] . "
                                          and
                                            t.datetime between '" . $start . " 00:00:00' and '" . $end . " 23:59:59'
                                          group by
                                            c.name
                                          order by
                                            total desc
                                          ;
                                            "));
            return $this->layout = View::make("stats._category", array(
                'incidents' => $incidents,
                'sensor_name' => $input['nombre_sensor']
            ));
        }
    }

    public function severity()
    {

        return $this->layout = View::make("stats.severity", array());

    }

    public function severityGraph()
    {
        $input = Input::all();

        //print_r($input);
        if ($input['start'] != '' && $input['end'] != '') {
            $start = explode("/", $input['start'])[2] . "-" . explode("/", $input['start'])[0] . "-" . explode("/", $input['start'])[1];
            $end = explode("/", $input['end'])[2] . "-" . explode("/", $input['end'])[0] . "-" . explode("/", $input['end'])[1];
            $customer = $input['customer'];
            $incidents = DB::select(DB::raw(" select
                                            count(*) as total,
                                            i.criticity
                                          from
                                            incidents as i,
                                            time as t
                                          where
                                            i.customers_id=" . $customer . "
                                          and
                                            i.incidents_status_id>1
                                          and
                                            t.time_types_id=1
                                          and
                                            t.incidents_id=i.id
                                          and
                                            t.datetime between '" . $start . " 00:00:00' and '" . $end . " 23:59:59'
                                          group by
                                            i.criticity
                                          order by
                                            total desc
                                          ;
                                            "));

            return $this->layout = View::make("stats._severity", array(
                'incidents' => $incidents,
            ));
        }
    }


    /**
     * Muestra el formulario para las estadísticas por sensor
     *
     * @return mixed Vista relacionada
     */
    public function sensor()
    {
        return $this->layout = View::make("stats.sensor", array());
    }

    /**
     *  Muestra las gráficas del sensor(es) seleccionado(s)
     *
     * @return mixed Vista relacionada
     */
    public function sensorGraph()
    {

        $input = Input::all();

        if ($input['start'] != '' && $input['end'] != '') {
            $start = explode("/", $input['start'])[2] . "-" . explode("/", $input['start'])[0] . "-" . explode("/", $input['start'])[1];
            $end = explode("/", $input['end'])[2] . "-" . explode("/", $input['end'])[0] . "-" . explode("/", $input['end'])[1];
            $customer = $input['customer'];

            $incidents = DB::select(DB::raw(" select count(*) as total, i.criticity
                                          from incidents as i, time as t
                                            where i.customers_id=" . $customer . "
                                                and i.incidents_status_id>1
                                                and t.time_types_id=1
                                                and t.incidents_id=i.id
                                                and t.datetime between '" . $start . " 00:00:00' and '" . $end . " 23:59:59'
                                          group by i.sensors_id
                                          order by total desc;
                                            "));

            return $this->layout = View::make("stats._sensor", array(
                'incidents' => $incidents,
            ));
        }
    }

    /**
     * Muestra la vista con el formulario para generar las gráficas por sensor, agrupadas por severidad
     *
     * @return mixed Vista relacionada
     */
    public function sensorSeverity()
    {
        return $this->layout = View::make("stats.sensor_severity", array());
    }

    /**
     * Muestra la vista con las gráficas por sensor, agrupadas por severidad
     *
     * @return mixed Vista relacionada
     */
    public function sensorSeverityGrahp()
    {
        $input = Input::all();
        if ($input['start'] != '' && $input['end'] != '') {
            $start = explode("/", $input['start'])[2] . "-" . explode("/", $input['start'])[0] . "-" . explode("/", $input['start'])[1];
            $end = explode("/", $input['end'])[2] . "-" . explode("/", $input['end'])[0] . "-" . explode("/", $input['end'])[1];
            $customer = $input['customer'];
            $sensor = $input['sensor'];
            $nombre_sensor = $input['nombre_sensor'];

            $incidents = DB::select(DB::raw(" select count(*) as total,i.criticity
                                            from incidents as i, time as t
                                              where i.customers_id=" . $customer . "
                                                and i.sensors_id=" . $sensor . "
                                                and i.incidents_status_id>1
                                                and t.time_types_id=1
                                                and t.incidents_id=i.id
                                                and t.datetime between '" . $start . " 00:00:00' and '" . $end . " 23:59:59'
                                            group by i.criticity
                                            order by total desc;
                                            "));
            return $this->layout = View::make("stats._sensor_severity", array(
                'incidents' => $incidents, 'nombre_sensor' => $nombre_sensor
            ));

        }
    }

    public function handler()
    {
        return $this->layout = View::make("stats.handler", array());
    }

    public function handlerGraph()
    {
        $input = Input::all();
        $option = $input['option'];
        $incidents = null;


        if ($input['start'] != '' && $input['end'] != '') {
            $handlers = IncidentHandler::all();
            $start = explode("/", $input['start'])[2] . "-" . explode("/", $input['start'])[0] . "-" . explode("/", $input['start'])[1];
            $end = explode("/", $input['end'])[2] . "-" . explode("/", $input['end'])[0] . "-" . explode("/", $input['end'])[1];
            $customer = $input['customer'];
            $sensor = "";
            if ($input['sensor'] != "") {
                $sensor = "and i.sensors_id=" . $input['sensor'];
            }
            $incidents_by_handler = array();
            foreach ($handlers as $h) {
                if ($h->id != 1 && $h->id != 20) {

                    $incidents = DB::select(DB::raw(" select count(*), date_trunc('day',t.datetime) as date
                                                from incidents as i, time as t
                                                where i.id=t.incidents_id and
                                                t.time_types_id=1
                                                and i.customers_id=" . $input['customer'] . "
                                                and i.incident_handler_id=" . $h->id . "
                                                " . $sensor . "
                                                and t.datetime between '" . $start . " 00:00:00' and '" . $end . " 23:59:59'
                                                group by date order by date asc"));
                    $incidents_by_handler[$h->id]['incidents'] = $incidents;
                }

            }
            //print_r($incidents_by_handler[2]['incidents']);
            //return 0;
            return $this->layout = View::make("stats._handler", array(
                'incidents' => $incidents,
                'incidents_by_handler' => $incidents_by_handler,
                'handlers' => $handlers,
                'start' => $start,
                'end' => $end,
            ));
        }
    }

    public function blacklist()
    {
        $ips = DB::select(DB::raw("select o.ip, oh.location from occurrences as o, occurences_history oh where oh.occurences_id=o.id and blacklist=true and oh.id=(select id from occurences_history where occurences_id=o.id and location!='' order by id desc limit 1)"));
        return $this->layout = View::make("stats.blacklist", array(
            'blacklist' => $ips,

        ));
    }

    public function doc()
    {
        $ips = DB::select(DB::raw("select o.ip, oh.location from occurrences as o, occurences_history oh where oh.occurences_id=o.id and blacklist=true and oh.id=(select id from occurences_history where occurences_id=o.id and location!='' order by id desc limit 1)"));
        $html = $this->layout = View::make("stats.blacklist_doc", array(
            'blacklist' => $ips,

        ));
        $headers = array(
            "Content-type" => "application/vnd.ms-word",
            "Content-Disposition" => "attachment;Filename=Blacklist.doc"
        );
        return Response::make($html, 200, $headers);
    }


    public function get_IPListByOrigin()
    {
        return View::make('stats.ip_ori');

    }

    public function post_IPListByOrigin()
    {
        $start_date = Input::get('start_date') . ' ' . '00:00:00';
        $end_date = Input::get('end_date') . ' ' . '23:59:59';
        $ip_type = Input::get('ip_type');


        $ips = DB::table('occurrences AS O')->select('O.ip')->distinct()
            ->join('incidents_occurences AS IO', $ip_type == 'source_id' ? 'IO.source_id' : 'IO.destiny_id', '=', 'O.id')
            ->whereNull('IO.deleted_at')
            ->whereBetween('IO.created_at', array(new DateTime($start_date), new DateTime($end_date)))
            ->where('O.ip', '!=', '')
            ->get();

        return View::make('stats.ip_ori', array(
            'fuente' => $ip_type == 'source_id' ? 'Origen.' : 'Destino.',
            'update' => 'true',
            'iplist' => $ips,
            'start_date' => Input::get('start_date'),
            'end_date' => Input::get('end_date'),
            'type' => $ip_type
        ));
    }


    public function stream()
    {
        return View::make('stats.stream');
    }

    public function streamGraph()
    {
        $input = Input::all();
        if ($input['start'] != '' && $input['end'] != '') {
            $start = explode("/", $input['start'])[2] . "-" . explode("/", $input['start'])[0] . "-" . explode("/", $input['start'])[1];
            $end = explode("/", $input['end'])[2] . "-" . explode("/", $input['end'])[0] . "-" . explode("/", $input['end'])[1];
            $customer = $input['customer'];
            $sensor = $input['sensor'];
            $query = " select count(*) as total,i.stream
                                          from incidents as i, time as t
                                            where i.customers_id=" . $customer . "
                                              and i.sensors_id=" . $sensor . "
                                              and i.incidents_status_id>1
                                              and t.time_types_id=1
                                              and t.incidents_id=i.id
                                              and t.datetime between '" . $start . " 00:00:00' and '" . $end . " 23:59:59'
                                          group by i.stream
                                          order by total desc;
                                          ";

            $incidents = DB::select(DB::raw($query));
            $nombre_sensor = Sensor::find($sensor)->name;
            return $this->layout = View::make("stats._stream", array(
                'incidents' => $incidents, 'nombre_sensor' => $nombre_sensor
            ));

        }
    }

    public function ipIE()
    {
        return $this->layout = View::make('stats.ip_ie');
    }

    public function ipIEGraph()
    {
        $input = Input::all();
        if ($input['start'] != '' && $input['end'] != '') {
            $start = explode("/", $input['start'])[2] . "-" . explode("/", $input['start'])[0] . "-" . explode("/", $input['start'])[1];
            $end = explode("/", $input['end'])[2] . "-" . explode("/", $input['end'])[0] . "-" . explode("/", $input['end'])[1];
            $customer = $input['customer'];
            $ip_type = $input['ip_type'];

            $query = "select count(*) as total, regexp_replace(o.ip,'[ \\t]*','') as ip_rgx
                from occurrences as o
                    --left join incidents_occurences as io on io.source_id=o.id
                    left join incidents_occurences as io on o.id in (io.source_id,io.destiny_id)
                    left join incidents as i on i.id=io.incidents_id
                    left join time as t on t.incidents_id=i.id
                where t.datetime between '" . $start . " 00:00:00' and '" . $end . " 23:59:59'
                    and i.customers_id=" . $customer . "
                    and t.time_types_id=1
                    and o.occurrences_types_id=" . $ip_type . "
                group by ip_rgx
                order by total desc;";

            $ips = DB::select(DB::raw($query));
            $occurence_type = OccurenceType::find($ip_type)->name;
            return $this->layout = View::make("stats._ip_ie",
                array('start' => $start, 'end' => $end, 'customer' => $customer, 'ip_type' => $ip_type,
                    'ips' => $ips, "occurence_type" => $occurence_type));
        }
    }

    public function ipIEDoc()
    {
        $start_date = Input::get('s');
        $end_date = Input::get('e');
        $ip_type = Input::get('t');
        $customer_id = Input::get('c');

        $query = "select count(*) as total, regexp_replace(o.ip,'[ \\t]*','') as ip_rgx
                from occurrences as o
                    --left join incidents_occurences as io on io.source_id=o.id
                    left join incidents_occurences as io on o.id in (io.source_id,io.destiny_id)
                    left join incidents as i on i.id=io.incidents_id
                    left join time as t on t.incidents_id=i.id
                where t.datetime between '" . $start_date . " 00:00:00' and '" . $end_date . " 23:59:59'
                    and i.customers_id=" . $customer_id . "
                    and t.time_types_id=1
                    and o.occurrences_types_id=" . $ip_type . "
                group by ip_rgx
                order by total desc;";

        $ips = DB::select(DB::raw($query));
        $occurence_type = OccurenceType::find($ip_type)->name;
        $htmlReport = View::make('stats.ip_ie_doc', array(
            'ips' => $ips
        ))->render();


        $headers = array(
            "Content-Type" => "application/vnd.ms-word;charset=utf-8",
            "Content-Disposition" => "attachment;Filename=Ocurrencias_IP_$occurence_type.doc"
        );

        return Response::make($htmlReport, 200, $headers);
    }

}