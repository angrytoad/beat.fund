<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 22/06/2018
 * Time: 01:14
 */
namespace App\Http\Controllers\Storefront\Tickets;

use App\Exceptions\CheckoutProcessingException;
use App\Http\Controllers\Controller;
use App\Library\Contracts\TicketCartInterface;
use App\Library\Contracts\TicketCheckoutInterface;
use App\Library\Contracts\TicketGenerationInterface;
use App\Mail\Storefront\TicketOrderCompleted;
use App\Models\StripeCustomerAccountCard;
use App\Models\TicketOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Webpatser\Uuid\Uuid;

class TicketsCheckoutController extends Controller
{

    public $ticketCartInterface;
    public $ticketCheckoutInterface;
    public $ticketGenerationInterface;

    /**
     * TicketsCheckoutController constructor.
     * @param TicketCartInterface $ticketCartInterface
     * @param TicketCheckoutInterface $ticketCheckoutInterface
     * @param TicketGenerationInterface $ticketGenerationInterface
     */
    public function __construct(
        TicketCartInterface $ticketCartInterface, 
        TicketCheckoutInterface $ticketCheckoutInterface,
        TicketGenerationInterface $ticketGenerationInterface
    )
    {
        $this->ticketCartInterface = $ticketCartInterface;
        $this->ticketCheckoutInterface = $ticketCheckoutInterface;
        $this->ticketGenerationInterface = $ticketGenerationInterface;
    }

    public function cart(){
        return view('storefront.tickets.cart')->with([
            'cart' => $this->ticketCartInterface->getFormattedCart()
        ]);
    }

    public function show(){
        return view('storefront.tickets.checkout')->with([
            'cart' => $this->ticketCartInterface->getFormattedCart()
        ]);
    }

    public function checkout(Request $request){

        $cart = $this->ticketCartInterface->getFormattedCart();

        if($cart['total'] !== 0){
            try{
                if($request->has('card')){
                    $card = StripeCustomerAccountCard::find($request->get('card'));
                    if(!$card){
                        throw new CheckoutProcessingException('We don\'t have that card on file.');
                    }

                    if($card->stripe_customer_account->user->id !== Auth::user()->id){
                        throw new CheckoutProcessingException('We don\'t have that card on file.');
                    }

                    $this->ticketCheckoutInterface->processCart($cart, $card);
                }

                if($request->has('stripeToken')){
                    $this->ticketCheckoutInterface->processCart($cart, null, $request->get('stripeToken'));
                }

            }catch(CheckoutProcessingException $e){
                return back()->withErrors([
                    $e->getMessage()
                ]);
            }
        }

        foreach($cart['tickets'] as $cart_item){
            $ticket_order = new TicketOrder();
            $ticket_order->ticket_id = $cart_item['ticket']->id;
            $ticket_order->email = $cart_item['purchaser']['email'];
            $ticket_order->full_name = $cart_item['purchaser']['full_name'];
            $ticket_order->quantity = $cart_item['quantity'];
            $ticket_order->price_per_ticket = $cart_item['price'];
            $ticket_order->total_paid = $cart_item['price']*$cart_item['quantity'];
            $ticket_order->seed = Uuid::generate();
            $ticket_order->save();

            $qr_encode = $this->ticketGenerationInterface->generate($ticket_order->ticket->id, $ticket_order->id, $ticket_order->seed);

            Mail::to($cart_item['purchaser']['email'])->send(new TicketOrderCompleted($ticket_order, $qr_encode, $cart_item));
        }

        session()->remove('ticket_cart');

        return redirect(route('storefront.tickets'))->with([
            'alert-success' => 'Thanks for your order, we\'ve sent you your digital tickets via email, please check your inbox.'
        ]);
    }
}
