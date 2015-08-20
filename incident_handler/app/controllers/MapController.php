<?php

class MapController extends \BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('map.index');
    }

    public function locate($ip)
    {
        $json = GeoIP::getLocation($ip);
        return view('map', compact('json'));
    }

    public function location($ip)
    {
        $geoIP = GeoIP::getLocation($ip);
        return json_encode($geoIP);
    }

//    public function getIncidents()
//    {
//        $input = Request::all();
//        $items = $input['items'];
//
//        if (isset($input['last']) && $input['last'] != -1) {
//            $last = $input['last'];
//            $incidents = Incident::where('id', '>', $last)->orderBy('id', 'desc')->limit($items)->get(['id']);
//        } else {
//            $incidents = Incident::orderBy('id', 'desc')->limit($items)->get(['id']);
//        }
//
//        $occs = array();
//
//        foreach ($incidents as $index => $i) {
//            if ($index == 0) {
//                $last = $i->id;
//            }
//            $ios = $i->incidentOccurence;
//
//            foreach ($ios as $io) {
//                $occ['src'] = GeoIP::getLocation($io->src->ip);
//
//                if ($occ['src']['default']) {
//                    $occ['src'] = $this->changeDefault('src', $io->src->ip);
//                }
//
//                $occ['dst'] = GeoIP::getLocation($io->dst->ip);
//
//                if ($occ['dst']['default']) {
//                    $occ['dst'] = $this->changeDefault('dst', $io->dst->ip);
//                }
//
//                $occ['src']['incidents_id'] = $i->id;
//                $occ['dst']['incidents_id'] = $i->id;
//                array_push($occs, $occ);
//            }
//
//
//        }
//
//        $data = ['last' => $last, 'occs' => $occs];
//
//        return json_encode($data);
//    }

    public function getIncidents()
    {
        $input = Request::all();
        $items = $input['items'];

        if (isset($input['last']) && $input['last'] != -1) {
            $last = $input['last'];
            $occurences = IncidentOccurence::where('id', '>', $last)->orderBy('id', 'asc')->limit($items)->get();
        } else {
            $occurences = IncidentOccurence::orderBy('id', 'asc')->limit($items)->get();
        }

        $occs = array();
        $ios = $occurences;

        foreach ($ios as $index => $io) {
            if ($index == 0) {
                $last = $io->id;
            }
            $occ['src'] = GeoIP::getLocation($io->src->ip);

            if ($occ['src']['default']) {
                $occ['src'] = $this->changeDefault('src', $io->src->ip);
            }

            $occ['dst'] = GeoIP::getLocation($io->dst->ip);

            if ($occ['dst']['default']) {
                $occ['dst'] = $this->changeDefault('dst', $io->dst->ip);
            }

            $occ['src']['incidents_id'] = $io->incidents->id;
            $occ['dst']['incidents_id'] = $io->incidents->id;
            array_push($occs, $occ);
        }

        $data = ['last' => $last, 'occs' => $occs];

        return json_encode($data);
    }

    private function changeDefault($type, $ip)
    {
        $occ["ip"] = $ip;
        $occ["isoCode"] = "MX";
        $occ["country"] = "Mexico";
        $occ["city"] = "DF";
        $occ["state"] = "DF";
        $occ["postal_code"] = "06010";
        $occ["lat"] = 19.43;
        $occ["lon"] = -99.13;
        $occ["timezone"] = "America/Mexico_City";
        $occ["continent"] = "America";
        $occ["default"] = true;

        return $occ;
    }

    public function getLocations($ips)
    {
        $dots = array();

        foreach ($ips as $ip) {
            $loc = GeoIP::getLocation($ip->ip);
            $loc['id'] = $ip->id;
            array_push($dots, $loc);
        }

        return $dots;
    }

    public function myLocation()
    {
        $json = GeoIP::getLocation();
        return view('map', compact('json'));
    }
}
