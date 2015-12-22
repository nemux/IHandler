<?php

namespace App\Library;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Pdf
{
    /**
     * Genera el PDF con la vista correspondiente
     *
     * @param $case
     * @return \PDF
     */
    public static function generatePdf($case, $view)
    {
        $html = view($view, ['case' => $case, 'isPdf' => true])->render();
        $pdf = \PDF::loadHTML($html);
        return $pdf;
    }
}
