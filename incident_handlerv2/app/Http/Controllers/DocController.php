<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DocController extends Controller
{
    /**
     * Genera el Doc de Word con la vista correspondiente
     *
     * @param $case
     * @return \PDF
     */
    public static function generateDoc($case, $view)
    {
        $html = view($view, ['case' => $case, 'isPdf' => true])->render();
        return $html;
    }
}
