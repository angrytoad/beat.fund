<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 06/04/2018
 * Time: 23:48
 */

namespace App\Library\Services\Stripe;

use App\Exceptions\CheckoutProcessingException;
use App\Library\Contracts\TicketCheckoutInterface;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe as Stripe;
use Stripe\Charge as Charge;
use Stripe\Transfer as Transfer;
use Stripe\Balance as Balance;

class StripeTicketCheckout implements TicketCheckoutInterface
{

    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    private function createBillingArray($cart){
        $billables = [];
        foreach($cart['tickets'] as $ticket){

            $ticket_object = [];
            $ticket_object['ticket'] = $ticket['ticket'];
            $ticket_object['purchaser'] = $ticket['purchaser'];
            $ticket_object['price'] = $ticket['price'];
            $ticket_object['quantity'] = $ticket['quantity'];

            $ticket_owner = $ticket_object['ticket']->ticket_store->user->id;
            $connected_account = $ticket_object['ticket']->ticket_store->user->stripe_account;

            if(!array_key_exists($ticket_owner, $billables)){
                $billables[$ticket_owner] = [
                    'tickets' => [$ticket_object],
                    'total' => $ticket['price']*$ticket['quantity'],
                    'connect_id' => $connected_account->stripe_user_id
                ];
            }else{
                $billables[$ticket_owner]['tickets'][] = $ticket_object;
                $billables[$ticket_owner]['total'] += $ticket['price']*$ticket['quantity'];
            }
        }

        return $billables;
    }

    private function initialOrderCharge($cart, $card){
        $total = (int) $cart['total']+env('STRIPE_FEE');
        return Charge::create(array(
            'amount' => $total,
            'currency' => 'gbp',
            'source' => $card->card_token,
        ));
    }

    private function calculateBillableAmount($total){

        $cut = env('BEATFUND_SALES_SHARE',10);
        $cut /= 100;
        $cut = 1 - $cut;
        return (int) round($total*$cut, 0, PHP_ROUND_HALF_DOWN);
    }

    private function createTransfer($billable, $charge_id){
        return Transfer::create(array(
            'amount' => $this->calculateBillableAmount($billable['total']),
            'currency' => 'gbp',
            'destination' => $billable['connect_id'],
            'source_transaction' => $charge_id
        ));
    }

    public function processCart($cart, $card = null, $stripeToken = null)
    {
        $this->createBillingArray($cart);

        if($card === null){
            $card = new \stdClass();
            $card->card_token = $stripeToken;
        }

        try{

            $billables = $this->createBillingArray($cart);
            $charge = $this->initialOrderCharge($cart, $card);

            foreach($billables as $billable){
                $transfer = $this->createTransfer($billable, $charge->id);
            }

        }catch(\Stripe\Error\Base $e){
            Bugsnag::notifyException($e);
            throw new CheckoutProcessingException('We cannot process your payment at the moment, please try again at a later date.');
        }
    }

}