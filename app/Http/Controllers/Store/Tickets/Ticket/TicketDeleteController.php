<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/06/2018
 * Time: 16:50
 */

namespace App\Http\Controllers\Store\Tickets\Ticket;


use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketDeleteController extends Controller
{

    public function __construct()
    {
    }
    
    public function show($ticket_id)
    {
        $ticket = Ticket::find($ticket_id);
        return view('store.tickets.ticket.delete')->with([
            'ticket' => $ticket
        ]);
    }

    public function delete(Request $request, $ticket_id){
        
        $ticket = Ticket::find($ticket_id);
        $ticket->delete();

        return redirect(route('store.tickets.all'))->with([
            'alert-success' => $ticket->name.' has been successfully deleted from your store.'
        ]);
    }

}