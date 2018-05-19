<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 19/05/2018
 * Time: 01:03
 */

namespace App\Http\Controllers\Store\Tickets\Ticket;


use App\Http\Controllers\Controller;
use App\Models\Ticket;

class TicketController extends Controller
{

    public function show($uuid)
    {
        $ticket = Ticket::find($uuid);
        return view('store.tickets.ticket.ticket')->with([
            'ticket' => $ticket
        ]);
    }

}