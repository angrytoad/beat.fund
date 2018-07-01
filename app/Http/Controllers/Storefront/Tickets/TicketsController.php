<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 22/06/2018
 * Time: 01:43
 */
namespace App\Http\Controllers\Storefront\Tickets;

use App\Http\Controllers\Controller;
use App\Library\Contracts\TicketCartInterface;
use App\Library\Repositories\TicketStorefrontRepository;
use Illuminate\Http\Request;

class TicketsController extends Controller
{

    public $ticketStorefrontRepository;
    public $ticketCartInterface;

    /**
     * TicketsController constructor.
     * @param TicketStorefrontRepository $ticketStorefrontRepository
     * @param TicketCartInterface $ticketCartInterface
     */
    public function __construct(TicketStorefrontRepository $ticketStorefrontRepository, TicketCartInterface $ticketCartInterface)
    {
        $this->ticketStorefrontRepository = $ticketStorefrontRepository;
        $this->ticketCartInterface = $ticketCartInterface;
    }

    public function show()
    {
        return view('storefront.tickets.tickets')->with([
            'recent_tickets' => $this->ticketStorefrontRepository->getRecentTickets(),
            'ticket_cart' => $this->ticketCartInterface->getFormattedCart()
        ]);
    }

    public function search(Request $request){
        $request->validate([
            'search' => 'required'
        ]);

        return view('storefront.tickets.search_results')->with([
            'search_results' => $this->ticketStorefrontRepository->searchForTickets($request->get('search')),
            'search' => $request->get('search'),
            'ticket_cart' => $this->ticketCartInterface->getFormattedCart()
        ]);
    }
}
