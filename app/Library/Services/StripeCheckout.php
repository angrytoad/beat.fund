<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 06/04/2018
 * Time: 23:48
 */

namespace App\Library\Services;

use App\Exceptions\CheckoutProcessingException;
use App\Library\Contracts\CheckoutInterface;
use App\Models\Order;
use App\Models\OrderItem;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe as Stripe;
use Stripe\Charge as Charge;
use Stripe\Transfer as Transfer;
use Stripe\Balance as Balance;
use Webpatser\Uuid\Uuid;

class StripeCheckout implements CheckoutInterface
{

    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    private function createBillingArray($cart){
        $billables = [];
        foreach($cart['products'] as $product){
            $product_object = $product['product'];
            $product_owner = $product_object->store->user->id;
            $connected_account = $product_object->store->user->stripe_account;
            if(!array_key_exists($product_owner, $billables)){
                $billables[$product_owner] = [
                    'products' => [$product_object],
                    'total' => $product['price'],
                    'connect_id' => $connected_account->stripe_user_id
                ];
            }else{
                $billables[$product_owner]['products'][] = $product_object;
                $billables[$product_owner]['total'] += $product['price'];
            }
        }

        return $billables;
    }

    private function initialOrderCharge($cart, $card, $transfer_group){
        $total = (int) $cart['total']+env('STRIPE_FEE');
        $balance = Balance::retrieve();
        if($balance['available']['amount'] > $total){
            return Charge::create(array(
                'amount' => $total,
                'currency' => 'gbp',
                'customer' => $card->stripe_customer_account->stripe_customer_id,
                'source' => $card->card_token,
                'transfer_group' => $transfer_group
            ));
        }else{
            throw new CheckoutProcessingException('We cannot process your payment at the moment, please try again at a later date.');
        }

    }

    private function calculateBillableAmount($total){
        $cut = env('BEATFUND_SALES_SHARE',10);
        $cut /= 100;
        $cut = 1 - $cut;
        return (int) $total*$cut;
    }

    private function createTransfer($billable, $transfer_group){
        return Transfer::create(array(
            'amount' => $this->calculateBillableAmount($billable['total']),
            'currency' => 'gbp',
            'destination' => $billable['connect_id'],
            'transfer_group' => $transfer_group
        ));
    }

    public function processCart($cart, $card, $email = null)
    {
        $this->createBillingArray($cart);

        $user = Auth::user();

        try{

            $uuid = Uuid::generate()->string;

            $billables = $this->createBillingArray($cart);
            $charge = $this->initialOrderCharge($cart, $card, $uuid);

            foreach($billables as $billable){
                $transfer = $this->createTransfer($billable, $uuid);
            }

            $order = new Order();
            $order->id = $uuid;
            if($email){
                $order->email = $email;
            }else{
                $order->user_id = $user->id;
                $order->email = $user->email;
            }
            $order->save();

            foreach($cart['products'] as $product_id => $product){
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $product['product']->id;
                $orderItem->price_paid = $product['price'];
                $orderItem->save();
            }

        }catch(\Stripe\Error\Base $e){
            Bugsnag::notifyException($e);
            throw new CheckoutProcessingException('We cannot process your payment at the moment, please try again at a later date.');
        }
    }

}