<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class DashboardController extends Controller
{
    /**
     * Muestra el dashboard principal.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.index');
    }

    public function test()
    {
        return view('dashboard.test');
    }
}
