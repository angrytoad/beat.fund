<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 22/06/2018
 * Time: 01:14
 */
namespace App\Http\Controllers\Storefront\Tickets;

use App\Exceptions\TicketNotFoundException;
use App\Http\Controllers\Controller;
use App\Library\Contracts\TicketCartInterface;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketCartActionsController extends Controller
{

    public $ticketCartInterface;

    /**
     * TicketsCheckoutController constructor.
     * @param TicketCartInterface $ticketCartInterface
     */
    public function __construct(TicketCartInterface $ticketCartInterface)
    {
        $this->ticketCartInterface = $ticketCartInterface;
    }

    public function removeFromCart(Request $request, $slug){

        $ticket = Ticket::where('slug',$slug)->first();

        try{
            if(!$ticket){
                throw new TicketNotFoundException('Error removing ticket from Cart.');
            }

            $this->ticketCartInterface->removeFromCart($ticket);

        }catch(TicketNotFoundException $e){
            return back()->withErrors([
                $e->getMessage()
            ]);
        }

        return back()->with([
            'alert-info' => $ticket->name.' has been removed from your cart.'
        ]);
    }
}
