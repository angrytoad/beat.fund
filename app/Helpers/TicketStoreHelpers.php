<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 28/06/2018
 * Time: 09:02
 */

namespace App\Helpers;


use App\Models\Ticket;
use Carbon\Carbon;

class TicketStoreHelpers
{


    public function getAvailableTickets()
    {
        return Ticket::where('tickets.live', true)
            ->where('tickets.start','<',Carbon::now())
            ->get();
    }

}