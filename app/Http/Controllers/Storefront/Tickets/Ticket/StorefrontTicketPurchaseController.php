<?php

namespace App\Http\Controllers\Storefront\Tickets\Ticket;


use App\Exceptions\TicketNotFoundException;
use App\Http\Controllers\Controller;
use App\Library\Contracts\TicketCartInterface;
use App\Models\Ticket;
use Illuminate\Http\Request;

class StorefrontTicketPurchaseController extends Controller
{

    public $ticketCartInterface;

    public function __construct(TicketCartInterface $ticketCartInterface)
    {
        $this->ticketCartInterface = $ticketCartInterface;
    }

    public function confirmDetails(Request $request, $slug){
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|confirmed|email',
            'total_tickets' => 'required|numeric'
        ]);

        $ticket = Ticket::where('slug',$slug)->first();
        
        $purchaser_details = [
            'full_name' => $request->get('full_name'),
            'email' => $request->get('email')
        ];
        
        try{
            if($ticket->price === null){
                $request->validate([
                    'price_per_ticket' => 'required|numeric'
                ]);
                $this->ticketCartInterface->addToCart(
                    $ticket, 
                    $request->get('price_per_ticket'), 
                    (int) $request->get('total_tickets'),
                    $purchaser_details
                );
            }else{
                $this->ticketCartInterface->addToCart(
                    $ticket, 
                    $ticket->price, 
                    (int) $request->get('total_tickets'),
                    $purchaser_details
                );
            }
        }catch(TicketNotFoundException $e){
            return back()->withErrors([
                $e->getMessage()
            ]);
        }

        return redirect(route('storefront.tickets.cart'))->with([
            'alert-info' => 'Tickets for '.$ticket->name.' have been added to your cart.'
        ]);
    }

}