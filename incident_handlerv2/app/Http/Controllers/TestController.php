<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function indexFiles()
    {
        return view('test.files.index');
    }

    public function createFiles()
    {

    }

    public function storeFiles(Request $request)
    {
//        \Log::info($request);
    }
}
