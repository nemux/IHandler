<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Asset\Asset;
use App\Models\Incident\Machine;

class MachineController extends Controller
{
    public function blacklist()
    {
        $machines = Asset::select(\DB::raw('asset.ipv4,string_agg(DISTINCT location.name,\' | \') as location'))
            ->leftJoin('machine', 'machine.asset_id', '=', 'asset.id')
            ->leftJoin('location', 'location.id', '=', 'machine.location_id')
            ->where('machine.blacklist','true')
            ->where('machine.deleted_at')
            ->groupBy('asset.ipv4')
            ->get();

        return view('catalog.machine.index', compact('machines'));
    }
}
