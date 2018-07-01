<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 22/06/2018
 * Time: 01:14
 */
namespace App\Http\Controllers\Storefront\Tickets;

use App\Http\Controllers\Controller;
use App\Library\Contracts\TicketCartInterface;

class TicketsCheckoutController extends Controller
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

    public function cart(){
        return view('storefront.tickets.cart')->with([
            'cart' => $this->ticketCartInterface->getFormattedCart()
        ]);
    }

    public function show(){
        return view('storefront.tickets.checkout');
    }
}
