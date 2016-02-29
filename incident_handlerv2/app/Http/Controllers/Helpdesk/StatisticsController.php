<?php

namespace App\Http\Controllers\Helpdesk;

use App\Http\Requests;
use Models\Helpdesk\Ticket\Ticket as HelpdeskTicket;

class StatisticsController extends \App\Http\Controllers\StatisticsController
{
    /**
     * Devuelve una respuesta Json con una lista con la cuenta de tickets por día, por cliente, de los últimos {$days} días
     *
     * @param $days
     * @return \Illuminate\Http\JsonResponse
     */
    public function ticketsCustomer($days)
    {
        //Si está definida la variable de días y es de tipo numérico
        if (isset($days) && is_numeric($days)) {
            $toDate = new \DateTime();
            $interval = new \DateInterval("P" . ($days - 1) . "D");

            /**
             * Quitar $interval a $toDate
             */
            $fromDate = date_sub(new \DateTime(), $interval);


            $sql = HelpdeskTicket::where('created_at', '>=', $fromDate->format('Y-m-d'))
                ->with('customer')
                ->select(\DB::raw('customer_id, count(customer_id) as count, to_char(created_at, \'YYYY-MM-DD\') as date'))
                ->groupBy(['customer_id', 'date'])
                ->orderBy('date', 'asc');

            $tickets = $sql->get();

            $customers = self::tableToDatasource2($tickets, 'customer', self::RELATION_DATE);

            $customers = self::fullTableDatesValues($customers, $fromDate, $toDate, 0);

            return \Response::json($customers);
        } else {
            return \Response::json(self::BAD_REQUEST_PARAMS);
        }
    }
}
