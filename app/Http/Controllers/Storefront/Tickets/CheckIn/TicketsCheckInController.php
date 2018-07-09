<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 05/07/2018
 * Time: 02:05
 */
namespace App\Http\Controllers\Storefront\Tickets\CheckIn;

use App\Http\Controllers\Controller;
use App\Models\TicketCheckin;
use App\Models\TicketOrder;

class TicketsCheckInController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    public function checkIn($ticket_id, $ticket_order_id, $seed){
        $ticketOrder = TicketOrder::where('ticket_id',$ticket_id)->where('id',$ticket_order_id)->where('seed',$seed)->first();

        $ticketCheckin = new TicketCheckin();
        $ticketCheckin->ticket_order_id = $ticketOrder->id;
        $ticketCheckin->save();

        return view('storefront.tickets.ticket.checkin')->with([
            'ticket' => $ticketOrder->ticket,
            'ticket_order' => $ticketOrder,
            'checkin_success' => true,
        ]);
    }
}
