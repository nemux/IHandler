<?php

namespace App\Library;

use App\Http\Requests;

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
//        $pdf = \PDF::loadHTML($html);
        $pdf = \PDF::loadView($view, ['case' => $case, 'isPdf' => true]);
        return $pdf;
    }
}
