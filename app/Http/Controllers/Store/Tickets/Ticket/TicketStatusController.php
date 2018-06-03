<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/06/2018
 * Time: 13:58
 */

namespace App\Http\Controllers\Store\Tickets\Ticket;


use App\Http\Controllers\Controller;
use App\Models\Ticket;

class TicketStatusController extends Controller
{

    public function __construct()
    {

    }

    public function live($ticket_id){
        $ticket = Ticket::find($ticket_id);
        $ticket->live = true;
        $ticket->save();

        return back()->with([
            'alert-success' => 'Your ticket has been successfully set live.'
        ]);
    }

    public function pending($ticket_id){
        $ticket = Ticket::find($ticket_id);
        $ticket->live = false;
        $ticket->save();

        return back()->with([
            'alert-success' => 'Your ticket has been successfully set pending.'
        ]);
    }

}