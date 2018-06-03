<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 14/05/2018
 * Time: 21:01
 */

namespace App\Http\Controllers\Storefront\Tickets\Ticket;


use App\Http\Controllers\Controller;
use App\Models\Ticket;

class StorefrontTicketController extends Controller
{

    public function __construct()
    {

    }

    public function show($slug){
        $ticket = Ticket::where('slug','=',$slug)->first();

        return view('storefront.tickets.ticket')->with([
            'preview' => false,
            'ticket' => $ticket
        ]);
    }

}