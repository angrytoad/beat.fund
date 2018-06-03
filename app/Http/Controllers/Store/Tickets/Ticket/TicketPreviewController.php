<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 02/06/2018
 * Time: 17:01
 */
namespace App\Http\Controllers\Store\Tickets\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket;

class TicketPreviewController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    public function show($ticket_id)
    {
        $ticket = Ticket::find($ticket_id);

        return view('storefront.tickets.ticket')->with([
            'preview' => true,
            'ticket' => $ticket
        ]);
    }
}
